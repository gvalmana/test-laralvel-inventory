<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    protected $fillable = [
        'nombre',
        'serie',
        'existencia',
        'precio_venta',
        'precio_compra'
    ];
    protected $appends = [
        'deletable',
        '_links',
        'compras',
        'facturado'
    ];
    
    
    public function ventas(){
        return $this->hasMany(Venta::class);
    }

    public function getLinksAttribute()
    {
        return [
            'self' => route('productos.show',['producto'=>$this])
        ];
    }
    
    public function getDeletableAttribute()
    {
        if ($this->ventas()->exists()) {
            return false;
        }
        return true;
    }
    
    public function getComprasAttribute()
    {
        $total = $this->ventas()->count();
        return $total;
    }
    public function getFacturadoAttribute()
    {
        return $this->ventas()->count() * $this->precio_venta;
    }
}
