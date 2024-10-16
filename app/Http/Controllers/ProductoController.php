<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar la lista de productos
    public function index()
    {
        $products = Producto::all(); // Obtener todos los productos
        return view('shop', ['products' => $products]);
    }


}
