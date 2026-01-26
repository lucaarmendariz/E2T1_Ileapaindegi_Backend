<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Student;
use App\Models\Client;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();
        $client = Client::first();

        Appointment::create([
            'date' => '2026-01-25',
            'seat' => 1,
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'comments' => 'Primera cita de prueba',
            'student_id' => $student->id,
            'client_id' => $client->id
        ]);

        Appointment::create([
            'date' => '2026-01-26',
            'seat' => 2,
            'start_time' => '14:00:00',
            'end_time' => '15:30:00',
            'comments' => 'Segunda cita de prueba',
            'student_id' => $student->id,
            'client_id' => $client->id
        ]);
    }
}
