<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Group;
use App\Models\User;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los grupos existentes
        $groups = Group::all();

        if ($groups->isEmpty()) {
            $this->command->info('No hay grupos disponibles. Ejecuta primero GroupSeeder.');
            return;
        }

        $users = User::all();

        Student::create([
            'name' => 'Jon',
            'surnames' => 'Doe',
            'group_id' => 3,
            'user_id' => $users->get(0)->id
        ]);

        Student::create([
            'name' => 'Anna',
            'surnames' => 'Smith',
            'group_id' => $groups->random()->id,
            'user_id' => $users->get(1)->id
        ]);

        Student::create([
            'name' => 'Luis',
            'surnames' => 'Garcia',
            'group_id' => $groups->random()->id,
            'user_id' => $users->get(2)->id
        ]);

        Student::create([
            'name' => 'Maria',
            'surnames' => 'Fernandez',
            'group_id' => $groups->random()->id,
            'user_id' => $users->get(3)->id
        ]);

    }
}
