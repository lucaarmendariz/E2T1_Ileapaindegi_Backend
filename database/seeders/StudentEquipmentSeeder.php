<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentEquipment;
use App\Models\Student;
use App\Models\Equipment;

class StudentEquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();
        $equipment = Equipment::first();

        if ($student && $equipment) {
            StudentEquipment::create([
                'student_id' => $student->id,
                'equipment_id' => $equipment->id,
                'start_datetime' => now(),
                'end_datetime' => now()->addHour(),
            ]);
        }

        // Ejemplo adicional
        $student2 = Student::skip(1)->first();
        $equipment2 = Equipment::skip(1)->first();
        if ($student2 && $equipment2) {
            StudentEquipment::create([
                'student_id' => $student2->id,
                'equipment_id' => $equipment2->id,
                'start_datetime' => now()->addDays(1),
                'end_datetime' => now()->addDays(1)->addHour(),
            ]);
        }
    }
}
