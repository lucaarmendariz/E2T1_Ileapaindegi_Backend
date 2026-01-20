<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Crear clientes de ejemplo
        Client::create([
            'name' => 'Carlos',
            'surnames' => 'Lopez',
            'telephone' => '600123456',
            'email' => 'carlos.lopez@example.com',
            'home_client' => true,
        ]);

        Client::create([
            'name' => 'Lucia',
            'surnames' => 'Martinez',
            'telephone' => '600654321',
            'email' => 'lucia.martinez@example.com',
            'home_client' => false,
        ]);

        Client::create([
            'name' => 'Diego',
            'surnames' => 'Fernandez',
            'telephone' => '600987654',
            'email' => 'diego.fernandez@example.com',
            'home_client' => true,
        ]);

        Client::create([
            'name' => 'Elena',
            'surnames' => 'Gomez',
            'telephone' => '600456789',
            'email' => 'elena.gomez@example.com',
            'home_client' => false,
        ]);
    }
}
