<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends RestModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'ventas';
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $keyType = 'integer';
    protected $perPage = 15;
    const MODEL = 'Venta';
    const RELATIONS = ['producto'];
    const PARENT = [];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [
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

    public function getPrincipalAttribute()
    {
        return 'id';
    }
    
    public function getDeletableAttribute()
    {
        if ($this->producto()->exists()) {
            return false;
        }
        return true;
    }    
}
