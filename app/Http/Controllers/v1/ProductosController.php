<?php

namespace App\Http\Controllers\v1;

use App\Models\Producto;
use App\Http\Controllers\RestController;
use App\Services\ProductoService;

class ProductosController extends RestController
{
    /**
     *  ProductoController constructor.
     */
    public function __construct()
    {
        $classnamespace= Producto::class;
        $classnamespaceservice= ProductoService::class;
        $this->modelClass= new $classnamespace;
        $this->service= new $classnamespaceservice(new $classnamespace);
        $this->not_found_message = 'Producto no encontrado';
        $this->created_message = 'Producto registrado correctamente';
        $this->updated_message = 'Producto actualizado correctamente';
        $this->deleted_message = 'Producto elimiando correctamente';
    }    
}
