<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Producto as ProductoResource;
use App\Models\Producto;

class Venta extends JsonResource
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
            "type"=>"venta",
            "venta_id"=> $this->id,
            "attributes"=> [
                "fecha"=> $this->created_at,
                "cantidad" => $this->cantidad,
                "producto" => new ProductoSimple($this->producto),
            ],
            "_links"=> $this->_links,
            "deletable" => $this->deletable        
        ];        
    }
}
