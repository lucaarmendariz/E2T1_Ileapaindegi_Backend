<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Categorías de ejemplo
        Category::create([
            'name' => 'Protección personal', // Ej. guantes, cascos, etc.
        ]);

        Category::create([
            'name' => 'Electrónica', // Ej. dispositivos electrónicos
        ]);

        Category::create([
            'name' => 'Deporte', // Ej. equipamiento deportivo
        ]);

        Category::create([
            'name' => 'Oficina', // Ej. consumibles de oficina
        ]);
    }
}
