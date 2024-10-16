<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PaymentController;


// Mostrar la página de inicio con productos
Route::get('/', function () {
    $productos = DB::table('productos')->get();
    return view('shop', ['productos' => $productos]);
})->name('shop');

// Ver detalle de un producto
Route::get('/producto/{id}', function ($id) {
    $producto = DB::table('productos')->where('id', $id)->first();
    if (!$producto) {
        abort(404);
    }
    return view('detalle-producto', ['producto' => $producto]);
})->name('producto-detalle');

// Mostrar el carrito
Route::post('/carrito', [CartController::class, 'showCart'])->name('cart.show');



// Actualizar el carrito
// Actualizar el carrito
Route::post('/carrito/update', [CartController::class, 'updateCart'])->name('cart.update');

// Procesar el pedido (pago)
Route::post('/cart', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/procesar-pago', [PaymentController::class, 'processPayment'])->name('cart.processPayment');
Route::post('/procesar-pago', [PaymentController::class, 'processPayment'])->name('processPayment');

// Mostrar la vista de éxito de pago
Route::get('/success', function () {
    return view('success');
})->name('payment.success');

Route::post('/cart', [PaymentController::class, 'processPayment'])->name('processPayment');

// Mostrar la vista de éxito de pago
Route::get('/success', function () {
    return view('success');
})->name('payment.success');
// Mostrar el carrito

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/carrito', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart', [CartController::class, 'shoCart'])->name('cart');

Route::post('/carrito/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::post('/carrito/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
