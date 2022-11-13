<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrada extends Model
{
    use HasFactory, SoftDeletes;
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
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
            'href' => route('entradas.show',['venta'=>$this])
        ];
    }
    public function getDeletableAttribute()
    {
        if ($this->producto()->exists()) {
            return false;
        }
        return true;
    }
}
