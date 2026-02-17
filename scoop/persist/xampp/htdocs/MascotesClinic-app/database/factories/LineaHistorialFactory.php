<?php

namespace Database\Factories;

use App\Models\Mascota;
use Illuminate\Database\Eloquent\Factories\Factory;

class LineaHistorialFactory extends Factory
{
    public function definition(): array
    {
        $motivos = [
            'Vacunación', 
            'Revisión general', 
            'Consulta por enfermedad',
            'Desparasitación',
            'Control de peso',
            'Cirugía menor',
            'Limpieza dental'
        ];
        
        return [
            'fecha' => fake()->dateTimeBetween('-2 years', 'now'),
            'motivo_visita' => fake()->randomElement($motivos),
            'descripcion' => fake()->paragraph(),
            'mascota_id' => Mascota::factory(),
        ];
    }
}