<?php

namespace Database\Factories\v1;

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
            "serie" => fake()->unique()->randomNumber(9, true),
            "precio_compra" => fake()->randomFloat(2,0),
            "precio_venta" => fake()->randomFloat(2,0),
            "existencia" => fake()->numberBetween(1,20),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
