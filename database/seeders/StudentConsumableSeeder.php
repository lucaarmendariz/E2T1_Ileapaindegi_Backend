<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentConsumable;
use App\Models\Student;
use App\Models\Consumable;

class StudentConsumableSeeder extends Seeder
{
    public function run(): void
    {
        $student = Student::first();
        $consumable = Consumable::first();

        if ($student && $consumable) {
            StudentConsumable::create([
                'student_id' => $student->id,
                'consumable_id' => $consumable->id,
                'date' => now(),
                'quantity' => 2,
            ]);
        }

        // Ejemplo adicional
        $student2 = Student::skip(1)->first();
        $consumable2 = Consumable::skip(1)->first();
        if ($student2 && $consumable2) {
            StudentConsumable::create([
                'student_id' => $student2->id,
                'consumable_id' => $consumable2->id,
                'date' => now(),
                'quantity' => 1,
            ]);
        }
    }
}
