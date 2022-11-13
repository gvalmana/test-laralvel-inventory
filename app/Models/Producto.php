<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\RestModel;

class Producto extends RestModel
{
    use HasFactory, SoftDeletes;
    protected $table = 'productos';
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $keyType = 'integer';
    protected $perPage = 15;
    const MODEL = 'Producto';
    const RELATIONS = ['ventas'];
    const PARENT = [];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'nombre',
        'serie',
        'cantidad',
        'precio_venta',
        'precio_compra'
    ];
    protected $casts = [];
    
    protected $appends = [
    ];

    protected function rules($scenario='create')
    {

        $create = [
            'nombre' => 'required|max:255',
            'serie' => 'numeric|digits_between:15,15|nullable|unique:productos,serie',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'cantidad' => 'required',
        ];
        $update = $create;
        $update['id'] = 'required|unique:productos,id,'.$this->id.',id';
        $update['serie'] = 'numeric|digits_between:15,15|nullable|unique:productos,serie,'.$this->id.',id';
        
        
        $rules = [
            'create' => $create,
            'update' => $update
        ];
        if(!isset($rules[$scenario]))
            throw new \Exception('Scenario '.$scenario.' not exist');
        return $rules[$scenario];        
    }
    
    public function ventas(){
        return $this->hasMany(Venta::class, "producto_id","id");
    }

    public function getLinksAttribute()
    {
        return [
            'href' => route('productos.show',['producto'=>$this])
        ];
    }
    
    public function getDeletableAttribute()
    {
        if ($this->ventas()->exists()) {
            return false;
        }
        return true;
    }     
}
