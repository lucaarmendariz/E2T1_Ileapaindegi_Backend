<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // ===== PEINADO Y CORTE =====
        Service::create([
            'name' => 'Peinado',
            'price' => 5.00,
            'home_price' => 0,
            'duration' => 30,
        ]);

        Service::create([
            'name' => 'Corte',
            'price' => 4.00,
            'home_price' => 0,
            'duration' => 30,
        ]);

        // ===== COLOR =====
        Service::create([
            'name' => 'Color - Corto',
            'price' => 12.00,
            'home_price' => 0,
            'duration' => 60,
        ]);

        Service::create([
            'name' => 'Color - Medio',
            'price' => 14.00,
            'home_price' => 0,
            'duration' => 70,
        ]);

        Service::create([
            'name' => 'Color - Largo',
            'price' => 16.00,
            'home_price' => 0,
            'duration' => 80,
        ]);

        Service::create([
            'name' => 'Color - Extralargo',
            'price' => 18.00,
            'home_price' => 0,
            'duration' => 90,
        ]);

        // ===== MECHAS PARCIALES =====
        Service::create([
            'name' => 'Mechas parciales - Corto',
            'price' => 7.00,
            'home_price' => 0,
            'duration' => 60,
        ]);

        Service::create([
            'name' => 'Mechas parciales - Medio',
            'price' => 9.00,
            'home_price' => 0,
            'duration' => 70,
        ]);

        Service::create([
            'name' => 'Mechas parciales - Largo',
            'price' => 11.00,
            'home_price' => 0,
            'duration' => 80,
        ]);

        Service::create([
            'name' => 'Mechas parciales - Extralargo',
            'price' => 13.00,
            'home_price' => 0,
            'duration' => 90,
        ]);

        // ===== MECHAS =====
        Service::create([
            'name' => 'Mechas - Corto',
            'price' => 15.00,
            'home_price' => 0,
            'duration' => 90,
        ]);

        Service::create([
            'name' => 'Mechas - Medio',
            'price' => 17.00,
            'home_price' => 0,
            'duration' => 100,
        ]);

        Service::create([
            'name' => 'Mechas - Largo',
            'price' => 19.00,
            'home_price' => 0,
            'duration' => 110,
        ]);

        Service::create([
            'name' => 'Mechas - Extralargo',
            'price' => 21.00,
            'home_price' => 0,
            'duration' => 120,
        ]);

        // ===== MECHAS + COLOR =====
        Service::create([
            'name' => 'Mechas + Color - Corto',
            'price' => 25.00,
            'home_price' => 0,
            'duration' => 120,
        ]);

        Service::create([
            'name' => 'Mechas + Color - Medio',
            'price' => 27.00,
            'home_price' => 0,
            'duration' => 130,
        ]);

        Service::create([
            'name' => 'Mechas + Color - Largo',
            'price' => 29.00,
            'home_price' => 0,
            'duration' => 140,
        ]);

        Service::create([
            'name' => 'Mechas + Color - Extralargo',
            'price' => 31.00,
            'home_price' => 0,
            'duration' => 150,
        ]);

        // ===== OTROS SERVICIOS =====
        Service::create([
            'name' => 'Decoración',
            'price' => 4.00,
            'home_price' => 0,
            'duration' => 15,
        ]);

        Service::create([
            'name' => 'Permanente',
            'price' => 15.00,
            'home_price' => 0,
            'duration' => 120,
        ]);

        Service::create([
            'name' => 'Alisado permanente',
            'price' => 25.00,
            'home_price' => 0,
            'duration' => 150,
        ]);

        // ===== MANICURA Y PEDICURA =====
        Service::create([
            'name' => 'Manicura',
            'price' => 4.00,
            'home_price' => 0,
            'duration' => 30,
        ]);

        Service::create([
            'name' => 'Manicura semipermanente',
            'price' => 9.00,
            'home_price' => 0,
            'duration' => 45,
        ]);

        Service::create([
            'name' => 'Pedicura',
            'price' => 5.00,
            'home_price' => 0,
            'duration' => 45,
        ]);

        Service::create([
            'name' => 'Tratamiento de parafina',
            'price' => 6.00,
            'home_price' => 0,
            'duration' => 30,
        ]);

        Service::create([
            'name' => 'Chocolaterapia',
            'price' => 6.00,
            'home_price' => 0,
            'duration' => 30,
        ]);

        // ===== TRATAMIENTOS CAPILARES =====
        Service::create([
            'name' => 'Tratamiento de hidratación',
            'price' => 8.00,
            'home_price' => 0,
            'duration' => 45,
        ]);

        Service::create([
            'name' => 'Tratamiento reconstruct',
            'price' => 8.00,
            'home_price' => 0,
            'duration' => 45,
        ]);

        Service::create([
            'name' => 'Tratamiento de keratina Salerm',
            'price' => 35.00,
            'home_price' => 0,
            'duration' => 120,
        ]);

        Service::create([
            'name' => 'Tratamiento de keratina Kerapro',
            'price' => 45.00,
            'home_price' => 0,
            'duration' => 150,
        ]);

        Service::create([
            'name' => 'Tratamiento Thalassotherapy',
            'price' => 12.00,
            'home_price' => 0,
            'duration' => 60,
        ]);
    }
}
