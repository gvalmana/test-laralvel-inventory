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

    public $base_url = '/api/v1/productos';

    public function test_url_correct()
    {
        $this->withExceptionHandling();

        $response = $this->get($this->base_url);

        $response->assertStatus(204);
    }

    public function test_listar_productos()
    {
        $this->withExceptionHandling();
        $productos = Producto::factory(2)->create();
        $response = $this->getJson($this->base_url);
        $response->assertStatus(200);
        $primero = $productos->first();
        $ultimo = $productos->last();
        $this->assertCount(2, Producto::all());
        $response->assertJson(
            [
                [
                    "id" => $primero->id,
                    "nombre" => $primero->nombre,
                    "serie" => $primero->serie,
                    "precio_compra" => $primero->precio_compra,
                    "precio_venta" => $primero->precio_venta,
                    "cantidad" => $primero->cantidad
                ],
                [
                    "id" => $ultimo->id,
                    "nombre" => $ultimo->nombre,
                    "serie" => $ultimo->serie,
                    "precio_compra" => $ultimo->precio_compra,
                    "precio_venta" => $ultimo->precio_venta,
                    "cantidad" => $ultimo->cantidad                    
                ],                     
            ]            
        );
    }   

    public function test_un_producto_se_puede_obtener()
    {
        $this->withExceptionHandling();
        $producto = Producto::factory(1)->create();
        $response = $this->getJson($this->base_url."/".$producto->first()->id);
        $response->assertStatus(200);
        $primero = $producto->first();
        $response->assertJson([
            "success" => true,
            "data" => [
                "nombre" => $primero->nombre,
                "serie" => $primero->serie,
                "precio_compra" => $primero->precio_compra,
                "precio_venta" => $primero->precio_venta,
                "cantidad" => $primero->cantidad   
            ],
        ]);        
    }

    public function test_un_producto_puede_ser_eliminado()
    {
        $this->withExceptionHandling();
        $producto = Producto::factory(1)->create();
        $response = $this->deleteJson($this->base_url."/".$producto->first()->id);
        $primero = $producto->first();
        $response->assertStatus(200);
        $response->assertJson([
            "message" => "Producto elimiando correctamente",
            "success" => true,
            "data" => [
                "id" => $primero->id,
                "nombre" => $primero->nombre,
                "serie" => $primero->serie,
                "precio_compra" => $primero->precio_compra,
                "precio_venta" => $primero->precio_venta,
                "cantidad" => $primero->cantidad     
            ],
        ]);        
    }    
}
