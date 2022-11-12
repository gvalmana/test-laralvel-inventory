<?php

namespace Database\Factories\v1;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\v1\Producto;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\v1\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "fecha"=> fake()->dateTime(),
            "cantidad"=> fake()->randomDigit(),
            "product_id"=> Producto::make(),
            "created_at"=> now(),
            "updated_at" => now()
        ];
    }
}
