<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Client;
class CartController extends Controller
{
    // Mostrar el carrito
    // Mostrar el carrito
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('carrito', compact('cart', 'total'));
    }
    public function shoCart()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return view('cart', compact('cart', 'total'));
    }

    // Agregar un producto al carrito
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Producto::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->nombre,
                'price' => $product->precio,
                'quantity' => $quantity,
                'image' => $product->imagen
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Producto agregado al carrito');
    }

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $updatedCart = $request->input('cart', []);

        foreach ($updatedCart as $id => $item) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $item['quantity'];
            }
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }


    public function placeOrder(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string', // Usa 'name' en lugar de 'last_name'
            'address' => 'required|string',
            'city' => 'required|string',
            'region' => 'required|string',
            'postal_code' => 'nullable|string',
            'phone' => 'required|string',
        ]);

        // Crear una nueva instancia del modelo Client
        $client = new Client();
        $client->email = $request->input('email');
        $client->name = $request->input('name'); // Aquí se usa 'name' en lugar de 'last_name'
        $client->address = $request->input('address');
        $client->city = $request->input('city');
        $client->region = $request->input('region');
        $client->postal_code = $request->input('postal_code');
        $client->phone = $request->input('phone');

        // Guardar en la base de datos
        $client->save();

        // Vaciar el carrito después de completar la compra
        session()->forget('cart');

        // Redirigir a la vista success después de completar la compra con un mensaje de éxito
        return redirect()->route('success')->with('success', '¡Compra realizada con éxito!');
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        return response()->json(['cart' => $cart]);
    }


}
