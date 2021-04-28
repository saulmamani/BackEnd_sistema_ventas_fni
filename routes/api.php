<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//http://localhost:8000/api/prueba
Route::get("/prueba", function(){
    return \App\Models\Producto::all();
});

Route::get('productos', [\App\Http\Controllers\ProductoController::class, 'index']);
Route::get('productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'show']);
Route::delete('productos/{producto}', [\App\Http\Controllers\ProductoController::class, 'destroy']);

