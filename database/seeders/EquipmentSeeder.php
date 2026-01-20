<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        Equipment::create([
            'name' => 'Cinta de correr',
            'label' => 'Cardio 01',
            'description' => 'Cinta de correr para entrenamiento cardiovascular',
            'brand' => 'FitBrand'
        ]);

        Equipment::create([
            'name' => 'Bicicleta estática',
            'label' => 'Cardio 02',
            'description' => 'Bicicleta estática para ejercicios de baja intensidad',
            'brand' => 'SpinBrand'
        ]);

        Equipment::create([
            'name' => 'Máquina de pesas',
            'label' => 'Fuerza 01',
            'description' => 'Equipo de pesas multifunción para gimnasio',
            'brand' => 'StrongBrand'
        ]);
    }
}
