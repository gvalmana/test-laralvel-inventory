<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'nombre',
        'serie',
        'cantidad',
        'precio_venta',
        'precio_compra'
    ];
    
    public function ventas(){
        return $this->hasMany(Venta::class);
    }
}
