<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Producto::all(); // Retorna todos los productos

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|string',
            'en_stock' => 'boolean', // Asegúrate de validar este campo
        ]);

        // Crea el nuevo producto
        $producto = Producto::create($validatedData);

        return response()->json($producto, 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            // Añade validaciones para otros campos si es necesario
        ]);

        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->descripcion = $request->descripcion; // Si estás manejando este campo
        $producto->imagen = $request->imagen; // Si estás manejando este campo
        $producto->en_stock = $request->en_stock; // Si estás manejando este campo

        $producto->save();

        return response()->json($producto, 200); // Responde con el producto actualizado
    }

}
