<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\v1\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "nombre" => fake()->name(),
            "serie" => strval(fake()->unique()->randomNumber(9, true)),
            "precio_compra" => fake()->randomFloat(4, 0.1, 1000),
            "precio_venta" => fake()->randomFloat(4, 0.1, 1000),
            "cantidad" => fake()->numberBetween(0, 20),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
