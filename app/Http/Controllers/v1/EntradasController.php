<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntradaRequest;
use App\Http\Requests\UpdateEntradaRequest;
use App\Http\Resources\Entrada as EntradaResource;
use App\Http\Resources\EntradaCollection;
use App\Models\Entrada;
use App\Models\Producto;
use App\Traits\HttpResponsable;
use Throwable;

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
                $data = Entrada::all();
            } elseif (isset($parameters["pagesize"])) {
                $pagesize = $parameters["pagesize"];
                $data = Entrada::where([])->simplePaginate($pagesize);
            }
            return $this->makeResponseOK(new EntradaCollection($data), "Listado de entradas obtenido correctamente");
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
        try {
            $data = $request->input("entradas");
            $result = [];
            foreach ($data as $entrada):
                $temporal=[];
                $temporal["producto_id"]=$entrada["producto_id"];
                $temporal["cantidad"]=$entrada["cantidad"];
                $producto = Producto::find($temporal["producto_id"]);
                $valor = $producto->precio_compra * $entrada["cantidad"];
                $temporal["valor"]= $valor;
                $result[]= Entrada::create($temporal);        
            endforeach;          
            return $this->makeResponseCreated(new EntradaCollection($result));
        } catch (\Throwable $th) {
            throw $th;
        }
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
        try {
            return $this->makeResponseOK(new EntradaResource($entrada),"Detalles de entrada obtenido correctamente");
        } catch (Throwable $exception) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error al intentar obtener datos");
        } 
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
        try {
            $entrada->delete();
            return $this->makeResponseOK(new EntradaResource($entrada), "Entrada cancelada correctamente");
        } catch (\Throwable $th) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error interno del servidor al intentar actualizar productos");
        }        
    }
}
