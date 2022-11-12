<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CrudApiRestfull\Models\RestModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends RestModel
{
    use HasFactory;
    use SoftDeletes;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function producto(){
        return $this->hasOne(Producto::class,"id","producto_id");
    }
}
