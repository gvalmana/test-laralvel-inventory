<?php

namespace Tests\Feature;

use App\Models\Entrada;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class EntradaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    Use RefreshDatabase;
    public $base_url = '/api/entradas';

    public function test_url_correct()
    {
        $this->withExceptionHandling();

        $response = $this->get($this->base_url);

        $response->assertStatus(200);
    }

    public function test_list()
    {
        $this->withExceptionHandling();
        $producto = Producto::factory(1)->create()->first();
        $entradas = Entrada::factory(2)->create([
            "producto_id"=>$producto->id,
            "updated_at" => Carbon::now()->timestamp,
            "created_at" => Carbon::now()->timestamp
            ]     
        );
        $response = $this->getJson($this->base_url);
        $response->assertStatus(200);
        $primero = $entradas->first();
        $ultimo = $entradas->last();
        $response->assertJson([
            "success" => true,
            "message" => "Listado de entradas obtenido correctamente",
            "data" => [
                "items"=>[
                    [
                        "type"=> "entrada",
                        "entrada_id" => $primero->id,
                        "attributes"=>[
                            "fecha" => $primero->created_at->jsonSerialize(),
                            "cantidad" => $primero->cantidad,
                            "producto" => [
                                "producto_id"=> $producto->id,
                                "nombre"=> $producto->nombre,
                                "serie"=> $producto->serie
                            ]
                        ],
                        "_links"=> $primero->_links,
                        "deletable" => $primero->deletable                        
                    ],
                    [
                        "type"=> "entrada",
                        "entrada_id" => $ultimo->id,
                        "attributes"=>[
                            "fecha" => $ultimo->created_at->jsonSerialize(),
                            "cantidad" => $ultimo->cantidad,
                            "producto" => [
                                "producto_id"=> $producto->id,
                                "nombre"=> $producto->nombre,
                                "serie"=> $producto->serie
                            ]
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
        $producto = Producto::factory(1)->create()->first();
        $entrada = Entrada::factory(1)->create([
            "producto_id"=>$producto->id,
            "updated_at" => Carbon::now()->timestamp,
            "created_at" => Carbon::now()->timestamp
            ]     
        );
        $response = $this->getJson($this->base_url."/".$entrada->first()->id);
        $response->assertStatus(200);
        $primero = $entrada->first();
        $response->assertJson([
            "success"=>true,
            "message"=>"Detalles de entrada obtenido correctamente",
            "data"=>[
                "type"=> "entrada",
                "entrada_id" => $primero->id,
                "attributes"=>[
                    "fecha" => $primero->created_at->jsonSerialize(),
                    "cantidad" => $primero->cantidad,
                    "producto" => [
                        "producto_id"=> $producto->id,
                        "nombre"=> $producto->nombre,
                        "serie"=> $producto->serie
                    ]
                ],
                "_links"=> $primero->_links,
                "deletable" => $primero->deletable
            ]
        ]);    
    }
}
