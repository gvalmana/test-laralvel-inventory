<?php
use App\Http\Controllers\v1\VentasController;
use Illuminate\Support\Facades\Route;

Route::get('ventas/select2list', [VentasController::class,'select2list']);
Route::apiResource('ventas', VentasController::class);
Route::post('ventas/validate', [VentasController::class,'validate_model']);
Route::post('ventas/update_multiple', [VentasController::class,'update_multiple']);
Route::put('ventas/restore/{producto}', [VentasController::class,'restore']);