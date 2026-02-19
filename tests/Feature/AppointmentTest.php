<?php

use App\Models\Appointment;
use App\Models\Student;

test('appointments by date', function () {
    $student = Student::factory()->create();
    Appointment::factory()->create(['student_id' => $student->id, 'date' => '2026-01-01']);

    $response = $this->get("/api/appointments/by-date?date=2026-01-01");

    $response->assertStatus(200);
});

test('monthly occupancy', function () {
    $student = Student::factory()->create();
    Appointment::factory()->count(3)->create(['student_id' => $student->id, 'date' => '2026-01-15']);

    $response = $this->get("/api/appointments/occupancy/month?month=2026-01");

    $response->assertStatus(200);
});
