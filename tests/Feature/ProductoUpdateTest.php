<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public $base_url = '/api/productos';

    public function test_actualizar_producto()
    {
        $this->withExceptionHandling();
        $data = [
            "nombre"=> "Actualizado",
            "serie" => "987654321",
            "cantidad" => 3,
            "precio_compra" => 234.5,
            "precio_venta" => 345.0            
        ];
        Producto::factory(1)->create();
        $producto = Producto::all()->first();
        $response = $this->putJson($this->base_url."/".$producto->id, $data);
        $data_updated = Producto::all()->first();
        $response->assertJson([
            "message" => "Producto actualizado correctamente",
            "success" => true,
            "data" => [
                    "type"=> "producto",
                    "producto_id" => $data_updated->id,
                    "attributes"=>[
                        "nombre" => $data_updated->nombre,
                        "serie" => $data_updated->serie,
                        "precio_compra" => $data_updated->precio_compra,
                        "precio_venta" => $data_updated->precio_venta,
                        "cantidad" => $data_updated->cantidad
                ],      
            ],
        ]);
        $this->assertEquals($data_updated->nombre, $data["nombre"]);
        $this->assertEquals($data_updated->serie, $data["serie"]);
        $this->assertEquals($data_updated->precio_compra, $data["precio_compra"]);
        $this->assertEquals($data_updated->precio_venta, $data["precio_venta"]);
        $this->assertEquals($data_updated->cantidad, $data["cantidad"]);
    }
}
