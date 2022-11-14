<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;
use App\Http\Resources\VentaCollection;
use App\Models\Venta;
use App\Traits\HttpResponsable;
use App\Http\Resources\Venta as VentaResource;
use App\Models\Producto;
use App\Rules\VentaValidacion;
use Throwable;

class VentasController extends Controller
{
    use HttpResponsable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $parameters = request()->input();
            $data = Venta::all();
            if (empty($parameters)){
                $data = Venta::all();
            } elseif (isset($parameters["pagesize"])) {
                $pagesize = $parameters["pagesize"];
                $data = Venta::where([])->simplePaginate($pagesize);
            }            
            return $this->makeResponseOK(new VentaCollection($data), "Listado de ventas obtenido correctamente");
        } catch (\Throwable $th) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error al intentar obtener datos");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVentaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVentaRequest $request)
    {
        //
        try {
            $producto = Producto::find($request["producto_id"]);
            $validated = $request->validate(["cantidad" => ['required', new VentaValidacion($producto)]]);
            $valor = $producto->precio_venta * $request["cantidad"];            
            $venta = Venta::create(array_merge($request->all(),["valor"=>$valor]));
            return $this->makeResponseCreated(new VentaResource($venta));
        } catch (\Throwable $th) {
            throw $th;
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
        try {
            return $this->makeResponseOK(new VentaResource($venta),"Venta obtenido correctamente");
        } catch (Throwable $exception) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error al intentar obtener datos");
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVentaRequest  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
