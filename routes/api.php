<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('items', ItemController::class);

Route::apiResource('productos', ProductController::class);

Route::get('/productos', [ProductController::class, 'index']);
Route::post('/productos', [ProductController::class, 'store']);
Route::delete('/productos/{id}', [ProductController::class, 'destroy']);
Route::get('/nasa-proxy', [NasaController::class, 'getNasaData']);
Route::get('/nasa-proxy', function () {
    // Hacemos la solicitud a la API de la NASA
    $response = Http::get('http://tle.ivanstanojevic.me/api/tle', [
        'api_key' => 'wuDjwkdJomJ2rOOwrtHaopp8BjhL6WzBENifgfRu'
    ]);

    // Devolvemos la respuesta como JSON
    return $response->json();
});
