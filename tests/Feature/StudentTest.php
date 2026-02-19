<?php

use App\Models\Student;

test('show student', function () {
    $student = Student::factory()->create();

    $response = $this->get("/api/students/{$student->id}");

    $response->assertStatus(200);
});

test('store student', function () {
    $payload = [
        'first_name' => 'Juan',
        'last_name' => 'Perez',
        'email' => 'juan@example.com',
        'birth_date' => '2000-01-01'
    ];

    $response = $this->post("/api/students", $payload);

    $response->assertStatus(201)
             ->assertJsonFragment(['email' => 'juan@example.com']);
});

test('index students', function () {
    Student::factory()->count(3)->create();

    $response = $this->get("/api/students");

    $response->assertStatus(200)
             ->assertJsonCount(3);
});
