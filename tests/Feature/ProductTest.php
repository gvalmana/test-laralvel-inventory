<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    Use RefreshDatabase;

    public $base_url = '/api/productos';

    public function test_url_correct()
    {
        $this->withExceptionHandling();

        $response = $this->get($this->base_url);

        $response->assertStatus(200);
    }

    public function test_los_productos_pueden_ser_listados()
    {
        $this->withExceptionHandling();
        $productos = Producto::factory(2)->create();
        $response = $this->get($this->base_url);
        $response->assertStatus(200);
        $primero = $productos->first();
        $ultimo = $productos->last();
        $this->assertCount(2, Producto::all());
        $response->assertJson([
            "success" => true,
            "message" => "Listado de productos obtenido correctamente",
            "data" => [
                "items"=>[
                    [
                        "type"=> "producto",
                        "producto_id" => $primero->id,
                        "attributes"=>[
                            "nombre" => $primero->nombre,
                            "serie" => $primero->serie,
                            "precio_compra" => $primero->precio_compra,
                            "precio_venta" => $primero->precio_venta,
                            "cantidad" => $primero->cantidad
                        ]
                    ],
                    [
                        "type"=> "producto",
                        "producto_id" => $ultimo->id,
                        "attributes"=>[
                            "nombre" => $ultimo->nombre,
                            "serie" => $ultimo->serie,
                            "precio_compra" => $ultimo->precio_compra,
                            "precio_venta" => $ultimo->precio_venta,
                            "cantidad" => $ultimo->cantidad
                        ]
                    ],                    
                ],
            ],
        ]);
    }

    public function test_un_producto_se_puede_obtener()
    {
        $this->withExceptionHandling();
        $producto = Producto::factory(1)->create();
        $response = $this->get($this->base_url."/".$producto->first()->id);
        $response->assertStatus(200);
        $primero = $producto->first();
        $response->assertJson([
            "message" => "Producto obtenido correctamente",
            "success" => true,
            "data" => [
                    "type"=> "producto",
                    "producto_id" => $primero->id,
                    "attributes"=>[
                        "nombre" => $primero->nombre,
                        "serie" => $primero->serie,
                        "precio_compra" => $primero->precio_compra,
                        "precio_venta" => $primero->precio_venta,
                        "cantidad" => $primero->cantidad
                ],      
            ],
        ]);        
    }    
}
