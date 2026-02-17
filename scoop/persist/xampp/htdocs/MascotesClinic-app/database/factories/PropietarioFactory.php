<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropietarioFactory extends Factory {
    public function definition(): array {
        
        return [
            'nom' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'movil' => fake()->phoneNumber(),
        ];
    }
}