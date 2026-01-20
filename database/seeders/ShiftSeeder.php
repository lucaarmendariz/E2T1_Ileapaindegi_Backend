<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;
use App\Models\Student;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        // Suponiendo que ya existen estudiantes
        $student1 = Student::first();
        $student2 = Student::skip(1)->first();

        Shift::create([
            'type' => 'M', // Morning
            'date' => '2026-01-20',
            'student_id' => $student1->id
        ]);

        Shift::create([
            'type' => 'A', // Afternoon
            'date' => '2026-01-21',
            'student_id' => $student2->id
        ]);
    }
}
