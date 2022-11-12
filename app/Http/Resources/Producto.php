<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Producto extends JsonResource
{
    public static $wrap = 'producto';
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
                "cantidad" => $this->cantidad
            ],
        ];
    }
}
