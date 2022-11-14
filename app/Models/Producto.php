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
        'precio_venta',
        'precio_compra'
    ];
    protected $appends = [
        'deletable',
        '_links',
        'vendido',
        'facturado',
        'entradas',
        'costo',
        'utilidades',
        'categoria'
    ];
    
    
    public function ventas(){
        return $this->hasMany(Venta::class);
    }

    public function entradas(){
        return $this->hasMany(Entrada::class);
    }

    public function getLinksAttribute()
    {
        return [
            'self' => route('productos.show',['producto'=>$this])
        ];
    }
    
    public function getDeletableAttribute()
    {
        if ($this->ventas()->exists() or $this->entradas()->exists() or $this->cantidad>=0) {
            return false;
        }
        return true;
    }
    
    public function getVendidoAttribute()
    {
        return $this->ventas()->sum("cantidad");
    }

    public function getEntradasAttribute()
    {
        return $this->entradas()->sum("cantidad");
    }

    public function getFacturadoAttribute()
    {
        return $this->ventas()->sum("cantidad") * $this->precio_venta;
    }

    public function getCostoAttribute()
    {
        return $this->entradas()->sum("cantidad") * $this->precio_compra;
    }

    public function getUtilidadesAttribute()
    {
        return $this->getFacturadoAttribute() - $this->getCostoAttribute();
    }

    public function getGananciasAttribute()
    {
        try {
            if ($this->getCostoAttribute()<=0) {
                return 0;
            }
            return ($this->getUtilidadesAttribute())*100/ $this->getCostoAttribute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getCategoriaAttribute()
    {
        $porciento_ganancias = $this->getGananciasAttribute();
        if ($porciento_ganancias>50){
            return "Gama Alta";
        } elseif ($porciento_ganancias > 10 and $porciento_ganancias <= 50) {
            return "Gama Media";
        } else if ($porciento_ganancias<=10){
            return "Gama Baja";
        } else {
            return "Sin Clasificar";
        }
    }

    public function rebajarInventario($cantidad)
    {
        $res = $this->existencias - $cantidad;
        if ($res<=0) {
            $this->existencias = 0;
        }else{
            $this->existencias -= $cantidad;
        }
        $this->save();
    }

    public function entrarInventario($cantidad)
    {
        $this->existencias += $cantidad;
        $this->save();
    }
}
