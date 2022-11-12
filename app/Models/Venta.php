<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CrudApiRestfull\Models\RestModel;

class Venta extends RestModel
{
    use HasFactory;
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function producto(){
        return $this->hasOne(Producto::class,"id","producto_id");
    }
}
