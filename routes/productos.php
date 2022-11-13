<?php
use App\Http\Controllers\v1\ProductosController;
use Illuminate\Support\Facades\Route;

Route::get('productos/select2list', [ProductosController::class,'select2list']);
Route::apiResource('productos', ProductosController::class);
Route::post('productos/validate', [ProductosController::class,'validate_model']);
Route::post('productos/update_multiple', [ProductosController::class,'update_multiple']);
Route::put('productos/restore/{producto}', [ProductosController::class,'restore']);