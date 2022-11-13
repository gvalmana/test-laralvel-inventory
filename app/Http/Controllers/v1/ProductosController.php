<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use App\Traits\HttpResponsable;
use App\Http\Resources\ProductoCollection;
use App\Http\Resources\Producto as ProductoResource;
use Throwable;

class ProductosController extends Controller
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
                $data = Producto::all();
            } elseif (isset($parameters["pagesize"])) {
                $pagesize = $parameters["pagesize"];
                $data = Producto::where([])->simplePaginate($pagesize);
            }
            return $this->makeResponseOK(new ProductoCollection($data), "Listado de productos obtenido correctamente");
        } catch (\Throwable $th) {
            throw $th;
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error al intentar obtener datos");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {
        //
        try {
            $producto = Producto::create($request->all());
            return $this->makeResponseCreated(new ProductoResource($producto), "Producto creado correctamente");
        } catch (\Throwable $th) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error interno del servidor al intentar guardar productos");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        try {
            return $this->makeResponseOK(new ProductoResource($producto), "Producto obtenido correctamente");
        } catch (Throwable $exception) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error al intentar obtener datos");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductoRequest  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        //
        try {
            $producto->update($request->all());
            return $this->makeResponseCreated(new ProductoResource($producto), "Producto actualizado correctamente");
        } catch (\Throwable $th) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error interno del servidor al intentar actualizar productos");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            return $this->makeResponseOK(new ProductoResource($producto), "Producto elimiando correctamente");
        } catch (\Throwable $th) {
            return $this->makeResponse(false, "Ha ocurrido un error en la operación", 500, "Error interno del servidor al intentar actualizar productos");
        }
    }
}
