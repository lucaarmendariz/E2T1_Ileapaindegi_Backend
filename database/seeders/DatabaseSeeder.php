<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            StudentSeeder::class,
            CategorySeeder::class,
            ConsumableSeeder::class,
            EquipmentSeeder::class,
            ServiceSeeder::class,
            ClientSeeder::class,
            ScheduleSeeder::class,
            ShiftSeeder::class,
            AppointmentSeeder::class,
            AppointmentServiceSeeder::class,
            StudentConsumableSeeder::class,
            StudentEquipmentSeeder::class,
        ]);
    }

}
