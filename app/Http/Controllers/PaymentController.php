<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
        ]);

        // Crear un nuevo cliente
        Client::create($validated);

        session()->forget('cart'); // Vaciar el carrito después del pago

        // Lógica adicional para procesar el pago (por ejemplo, integración con pasarela de pago)

        return redirect()->route('payment.success');
    }
}
