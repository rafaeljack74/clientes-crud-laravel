<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;

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

Route::get('/categorias', [CategoriasController::class, 'index']);

Route::prefix('/clientes')->group(function () {
	Route::get('/', [ClientesController::class, 'index']);
	Route::get('/{id}', [ClientesController::class, 'show']);
	Route::post('/', [ClientesController::class, 'store']);
	Route::put('/{id}', [ClientesController::class, 'update']);
	Route::delete('/{id}', [ClientesController::class, 'destroy']);
});
