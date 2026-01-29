<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'rol' => 'A', // A = Admin
            'password' => Hash::make('hola'), // Contraseña hasheada
        ]);

        // Usuario normal
        User::create([
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'rol' => 'U', // U = Usuario.
            'password' => Hash::make('securepassword'), // Contraseña hasheada

        ]);

        // Otro usuario
        User::create([
            'username' => 'janedoe',
            'email' => 'janedoe@example.com',
            'rol' => 'U',
            'password' => Hash::make('securepassword'), // Contraseña hasheada
        ]);

        User::create([
            'username' => 'lucadoe',
            'email' => 'lucadoe@example.com',
            'rol' => 'U',
            'password' => Hash::make('securepassword'), // Contraseña hasheada
        ]);
    }
}
