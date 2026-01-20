<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Group;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Suponiendo que ya existen grupos
        $group1 = Group::first(); // toma el primer grupo
        $group2 = Group::skip(1)->first(); // segundo grupo

        Schedule::create([
            'day' => 1, // Lunes
            'start_date' => '2026-01-20',
            'end_date' => '2026-06-20',
            'start_time' => '09:00:00',
            'end_time' => '11:00:00',
            'group_id' => $group1->id
        ]);

        Schedule::create([
            'day' => 3, // Miércoles
            'start_date' => '2026-01-20',
            'end_date' => '2026-06-20',
            'start_time' => '14:00:00',
            'end_time' => '16:00:00',
            'group_id' => $group2->id
        ]);
    }
}
