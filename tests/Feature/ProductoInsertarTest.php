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


    public function test_create()
    {
        $this->withExceptionHandling();
        $data = [
            "nombre"=> "Test Product",
            "serie" => "123456789111111",
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
                        "existencias" => $producto->existencias
                    ],
                    "rentabilidad" => [
                        "total_ventas" => $producto->vendido,
                        "total_facturado" => $producto->facturado,
                        "total_entradas" => $producto->entradas,
                        "total_costo" => $producto->costo,
                        "utilidades" => $producto->utilidades,
                        "porciento_utilidades" => $producto->ganancias ."%"
                    ],                    

            ],
        ]);        
    }
}
