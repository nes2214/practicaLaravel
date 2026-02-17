<?php

namespace Database\Factories;

use App\Models\Propietario;
use Illuminate\Database\Eloquent\Factories\Factory;

class MascotaFactory extends Factory
{
    public function definition(): array
    {
        $nombres = ['Max', 'Luna', 'Bobby', 'Bella', 'Rocky', 'Lola', 'Toby', 'Coco', 'Simba', 'Nala'];
        
        return [
            'nom' => fake()->randomElement($nombres),
            'propietario_id' => Propietario::factory(),
        ];
    }
}