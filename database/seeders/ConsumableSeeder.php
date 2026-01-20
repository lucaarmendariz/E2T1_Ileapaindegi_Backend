<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consumable;
use App\Models\Category;

class ConsumableSeeder extends Seeder
{
    public function run(): void
    {
        // Primero nos aseguramos de que existan categorías
        $category1 = Category::firstOrCreate(['name' => 'Material deportivo']);
        $category2 = Category::firstOrCreate(['name' => 'Protección']);

        Consumable::create([
            'name' => 'Guantes',
            'description' => 'Guantes de protección para estudiantes',
            'batch' => 'B001',
            'brand' => 'ProtecBrand',
            'stock' => 100,
            'min_stock' => 10,
            'expiration_date' => '2026-12-31',
            'category_id' => $category2->id,
        ]);

        Consumable::create([
            'name' => 'Balón de fútbol',
            'description' => 'Balón oficial para entrenamientos',
            'batch' => 'B002',
            'brand' => 'SportBrand',
            'stock' => 30,
            'min_stock' => 5,
            'expiration_date' => '2030-01-01',
            'category_id' => $category1->id,
        ]);

        Consumable::create([
            'name' => 'Cinta elástica',
            'description' => 'Cinta para ejercicios de resistencia',
            'batch' => 'B003',
            'brand' => 'FlexBrand',
            'stock' => 50,
            'min_stock' => 10,
            'expiration_date' => '2027-06-30',
            'category_id' => $category1->id,
        ]);
    }
}
