<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CrudApiRestfull\Models\RestModel;

class Venta extends RestModel
{
    use HasFactory;
    
    public function producto(){
        return $this->hasOne(Producto::class);        
    }
}
