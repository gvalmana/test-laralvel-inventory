<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Services\VentaService;

class VentasController extends Controller
{
    /**
     *  VentasController constructor.
     */
    public function __construct()
    {
        $classnamespace= Venta::class;
        $classnamespaceservice= VentaService::class;
        $this->modelClass= new $classnamespace;
        $this->service= new $classnamespaceservice(new $classnamespace);
        $this->not_found_message = 'Deltalles de venta no encontrada';
        $this->created_message = 'Venta registrada correctamente';
        $this->updated_message = 'Venta actualizada correctamente';
    } 
}
