<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends RestModel
{
    use HasFactory;
    use SoftDeletes;
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'deletable',
        '_links',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */    
    protected $fillable = [
        'fecha',
        'cantidad',
        'producto_id'
    ];

    public function producto(){
        return $this->hasOne(Producto::class,"id","producto_id");
    }

    public function getLinksAttribute()
    {
        return [
            'href' => route('ventas.show',['venta'=>$this])
        ];
    }    
}
