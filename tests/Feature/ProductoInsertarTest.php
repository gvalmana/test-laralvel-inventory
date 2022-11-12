<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoInsertarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    Use RefreshDatabase;

    public $base_url = '/api/productos';


    public function test_insertar_producto()
    {
        $this->withExceptionHandling();
        $data = [
            "nombre"=> "Test Product",
            "serie" => "123456789",
            "cantidad" => "1",
            "precio_compra" => 234.5,
            "precio_venta" => 345.0
        ];
        $response = $this->postJson($this->base_url, $data);
        $response->assertCreated();
        $this->assertCount(1, Producto::all());
        $productos = Producto::all();
        $producto = $productos->first();
        $this->assertEquals($data["nombre"],$producto->nombre);
        $this->assertEquals($data["serie"],$producto->serie);
        $this->assertEquals($data["cantidad"],$producto->cantidad);
        $this->assertEquals($data["precio_compra"],$producto->precio_compra);
        $this->assertEquals($data["precio_venta"],$producto->precio_venta);
        $response->assertJson([
            "message" => "Producto creado correctamente",
            "success" => true,
            "data" => [
                    "type"=> "producto",
                    "producto_id" => $producto->id,
                    "attributes"=>[
                        "nombre" => $producto->nombre,
                        "serie" => $producto->serie,
                        "precio_compra" => $producto->precio_compra,
                        "precio_venta" => $producto->precio_venta,
                        "cantidad" => $producto->cantidad
                ],      
            ],
        ]);        
    }

    public function test_actualizar_producto()
    {
        $this->withExceptionHandling();
        $data = [
            "nombre"=> "Test Product",
            "serie" => "123456789",
            "cantidad" => "1",
            "precio_compra" => 234.5,
            "precio_venta" => 345.0
        ];
        Producto::factory(1)->create();
        $producto = Producto::all()->first();
        $response = $this->putJson($this->base_url."/".$producto->id, ["nombre"=>"Actualizado"]);
        $this->assertCount(1, Producto::all());
        
        $response->assertJson([
            "message" => "Producto actualizado correctamente",
            "success" => true,
            "data" => [
                    "type"=> "producto",
                    "producto_id" => $producto->id,
                    "attributes"=>[
                        "nombre" => "Actualizado",
                        "serie" => "123456789",
                        "precio_compra" => "1",
                        "precio_venta" => 234.5,
                        "cantidad" => 345.0
                ],      
            ],
        ]);        
    }
}
