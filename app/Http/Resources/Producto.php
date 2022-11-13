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
                "precio_compra"=> $this->precio_compra,
                "precio_venta" => $this->precio_venta,
                "existencia" => $this->existencia,
                "total_ventas" => $this->compras,
                "total_facturado" => $this->facturado
            ],
            "_links"=> $this->_links,
            "deletable" => $this->deletable
        ];
    }
}
