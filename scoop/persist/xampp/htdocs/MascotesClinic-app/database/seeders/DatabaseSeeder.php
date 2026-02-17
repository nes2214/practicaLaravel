<?php

namespace Database\Seeders;

use App\Models\Propietario;
use App\Models\Mascota;
use App\Models\LineaHistorial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear 10 propietarios
        Propietario::factory(10)->create()->each(function ($propietario) {
            // Cada propietario tiene entre 1 y 3 mascotas
            Mascota::factory(rand(1, 3))->create([
                'propietario_id' => $propietario->id
            ])->each(function ($mascota) {
                // Cada mascota tiene entre 2 y 5 líneas de historial
                LineaHistorial::factory(rand(2, 5))->create([
                    'mascota_id' => $mascota->id
                ]);
            });
        });
    }
}