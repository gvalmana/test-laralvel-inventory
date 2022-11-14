<?php

use App\Http\Controllers\v1\EntradasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\ProductosController;
use App\Http\Controllers\v1\VentasController;
use App\Http\Resources\ProductoCollection;
use App\Models\Producto;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource("ventas", VentasController::class)->only(["index","store", "destroy","show"]);
Route::apiResource("entradas", EntradasController::class)->only(["index","store", "destroy","show"]);
Route::apiResource("productos", ProductosController::class);

