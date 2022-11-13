<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntradaRequest;
use App\Http\Requests\UpdateEntradaRequest;
use App\Http\Resources\OperacionCollection;
use App\Models\Entrada;
use App\Models\Venta;
use App\Traits\HttpResponsable;

class EntradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use HttpResponsable;
    public function index()
    {
        //
        try {
            $parameters = request()->input();
            if (empty($parameters)){
                $data = Venta::all();
            } elseif (isset($parameters["pagesize"])) {
                $pagesize = $parameters["pagesize"];
                $data = Venta::where([])->simplePaginate($pagesize);
            }
            return $this->makeResponseOK(new OperacionCollection($data), "Listado de entradas obtenido correctamente");
        } catch (\Throwable $th) {
            throw $th;
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error al intentar obtener datos");
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEntradaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntradaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntradaRequest  $request
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntradaRequest $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        //
    }
}
