<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Asegúrate de agregar esto

class NasaController extends Controller
{
    public function getNasaData(): \Illuminate\Http\JsonResponse
    {
        try {
            // Realizamos la solicitud a la API de la NASA
            $response = Http::get('http://tle.ivanstanojevic.me/api/tle', [
                'api_key' => 'wuDjwkdJomJ2rOOwrtHaopp8BjhL6WzBENifgfRu'
            ]);

            // Verificamos si la solicitud fue exitosa
            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json(['message' => 'Error al obtener datos de la API de la NASA'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al procesar la solicitud', 'error' => $e->getMessage()], 500);
        }
    }
}
