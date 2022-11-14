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

    public function test_list()
    {
        $this->withExceptionHandling();
        $productos = Producto::factory(2)->create();
        $response = $this->getJson($this->base_url);
        $response->assertStatus(200);
        $primero = $productos->first();
        $ultimo = $productos->last();
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
                            "existencias" => $primero->existencias
                        ],
                        "rentabilidad" => [
                            "total_ventas" => $primero->vendido,
                            "total_facturado" => $primero->facturado,
                            "total_entradas" => $primero->entradas,
                            "total_costo" => $primero->costo,
                            "utilidades" => $primero->utilidades,
                            "porciento_utilidades" => $primero->ganancias ."%"
                        ],
                        "_links"=> $primero->_links,
                        "deletable" => $primero->deletable                        
                    ],
                    [
                        "type"=> "producto",
                        "producto_id" => $ultimo->id,
                        "attributes"=>[
                            "nombre" => $ultimo->nombre,
                            "serie" => $ultimo->serie,
                            "precio_compra" => $ultimo->precio_compra,
                            "precio_venta" => $ultimo->precio_venta,
                            "existencias" => $ultimo->existencias
                        ],
                        "rentabilidad" => [
                            "total_ventas" => $ultimo->vendido,
                            "total_facturado" => $ultimo->facturado,
                            "total_entradas" => $ultimo->entradas,
                            "total_costo" => $ultimo->costo,
                            "utilidades" => $ultimo->utilidades,
                            "porciento_utilidades" => $ultimo->ganancias ."%"
                        ],
                        "_links"=> $ultimo->_links,
                        "deletable" => $ultimo->deletable                                             
                    ],                    
                ],
            ],
        ]);
    }

    public function test_get()
    {
        $this->withExceptionHandling();
        $producto = Producto::factory(1)->create();
        $response = $this->getJson($this->base_url."/".$producto->first()->id);
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
                        "existencias" => $primero->existencias
                    ],
                    "rentabilidad" => [
                        "total_ventas" => $primero->vendido,
                        "total_facturado" => $primero->facturado,
                        "total_entradas" => $primero->entradas,
                        "total_costo" => $primero->costo,
                        "utilidades" => $primero->utilidades,
                        "porciento_utilidades" => $primero->ganancias ."%"
                    ],
                    "_links"=> $primero->_links,
                    "deletable" => $primero->deletable                      
                ],
            ]);        
    }

    public function test_delete()
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
                    "type"=> "producto",
                    "producto_id" => $primero->id,
                    "attributes"=>[
                        "nombre" => $primero->nombre,
                        "serie" => $primero->serie,
                        "precio_compra" => $primero->precio_compra,
                        "precio_venta" => $primero->precio_venta,
                        "existencias" => $primero->existencias
                    ],
                    "rentabilidad" => [
                        "total_ventas" => $primero->vendido,
                        "total_facturado" => $primero->facturado,
                        "total_entradas" => $primero->entradas,
                        "total_costo" => $primero->costo,
                        "utilidades" => $primero->utilidades,
                        "porciento_utilidades" => $primero->ganancias ."%"
                    ],
                    "_links"=> $primero->_links,
                    "deletable" => $primero->deletable                      
                ],
            ]);        
    }    
}
