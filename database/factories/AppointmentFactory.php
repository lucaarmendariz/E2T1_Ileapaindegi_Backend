<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class AppointmentFactory extends Factory
{
    protected $model = \App\Models\Appointment::class;

    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'status' => 'scheduled',
        ];
    }
}
