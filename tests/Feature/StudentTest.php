<?php

use App\Models\Student;
use App\Models\User;
use App\Models\Group;
use Laravel\Sanctum\Sanctum;


test('show student', function () {
    $user = User::create([
        'username' => 'Juan',
        'email' => 'hola@hola.com',
        'password' => 'hola',
        'rol' => 'A'
    ]);

    Sanctum::actingAs($user);

    $group = Group::create([
        'name' => '3WAG2'
    ]);

    $student = Student::create([
        'user_id' => $user->id,
        'name' => 'Juan',
        'surnames' => 'Perez',
        'group_id' => $group->id,
    ]);

    $response = $this->get("/api/students/{$student->id}");
    $response->assertStatus(200);
});

test('store student', function () {
    $payload = [
        'first_name' => 'Laura',
        'last_name' => 'Gomez',
        'email' => 'laura@example.com',
        'birth_date' => '2001-05-05'
    ];

    $response = $this->post("/api/students", $payload);
    $response->assertStatus(201)
             ->assertJsonFragment(['email' => 'laura@example.com']);
});

test('index students', function () {
    Student::create([
        'first_name' => 'Juan',
        'last_name' => 'Perez',
        'email' => 'juan@example.com',
        'birth_date' => '2000-01-01'
    ]);
    Student::create([
        'first_name' => 'Laura',
        'last_name' => 'Gomez',
        'email' => 'laura@example.com',
        'birth_date' => '2001-05-05'
    ]);

    $response = $this->get("/api/students");
    $response->assertStatus(200)
             ->assertJsonCount(2);
});
