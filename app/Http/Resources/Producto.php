<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Producto extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "type"=>"producto",
            "producto_id"=> $this->id,
            "attributes"=> [
                "nombre"=> $this->nombre,
                "serie" => $this->serie,
                "categoría" => $this->categoria,
                "precio_compra"=> $this->precio_compra,
                "precio_venta" => $this->precio_venta,
                "existencias" => $this->existencias,
            ],
            "rentabilidad" => [
                "total_ventas" => round($this->vendido),
                "total_facturado" => round($this->facturado, 2),
                "total_entradas" => round($this->entradas),
                "total_costo" => round($this->costo,2),
                "utilidades" => round($this->utilidades,2),
                "porciento_utilidades" => round($this->ganancias,2)
            ],
            "_links"=> $this->_links,
            "deletable" => $this->deletable
        ];
    }
}
