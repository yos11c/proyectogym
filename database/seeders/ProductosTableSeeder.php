<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Perfume A',
                'descripcion' => 'Descripción del Perfume A',
                'precio' => 250.00,
                'imagen' => 'perfume-a.jpg',
                'en_stock' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Perfume B',
                'descripcion' => 'Descripción del Perfume B',
                'precio' => 750.00,
                'imagen' => 'perfume-b.jpg',
                'en_stock' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Perfume C',
                'descripcion' => 'Descripción del Perfume C',
                'precio' => 600.00,
                'imagen' => 'perfume-c.jpg',
                'en_stock' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
