<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        // Grupos de ejemplo
        Group::create([
            'name' => 'Grupo A',
        ]);

        Group::create([
            'name' => 'Grupo B',
        ]);

        Group::create([
            'name' => 'Grupo C',
        ]);

        Group::create([
            'name' => 'Grupo D',
        ]);
    }
}
