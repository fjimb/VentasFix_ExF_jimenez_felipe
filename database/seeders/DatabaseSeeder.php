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
    public function run(): void
    {
        // Usuario administrador por defecto para iniciar sesión.
        // El email debe pertenecer al dominio @ventasfix.cl y la contraseña
        // se cifra automáticamente (cast 'hashed' en el modelo User).
        User::firstOrCreate(
            ['email' => 'felipe@ventasfix.cl'],
            [
                'rut' => '12.345.678-5',
                'nombre' => 'Felipe',
                'apellido' => 'Jiménez',
                'password' => 'password123',
            ]
        );
    }
}
