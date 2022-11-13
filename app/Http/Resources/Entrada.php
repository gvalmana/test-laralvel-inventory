<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Entrada extends JsonResource
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
            "type"=>"entrada",
            "entrada_id"=> $this->id,
            "attributes"=> [
                "fecha"=> $this->fecha,
                "cantidad" => $this->cantidad,
                "producto" => new ProductoSimple($this->producto),
            ],
            "_links"=> $this->_links,
            "deletable" => $this->deletable        
        ];        
    }
}
