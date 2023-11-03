<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('categories')->insert([
            'nombre_categoria' => 'TV VIDEO Y AUDIO',
            'descripcion' => 'Productos multimedia',
        ]);

        DB::table('categories')->insert([
            'nombre_categoria' => 'CÓMPUTO Y TELEFONÍA',
            'descripcion' => 'Electronica en general',
        ]);

        DB::table('categories')->insert([
            'nombre_categoria' => 'LÍNEA BLANCA',
            'descripcion' => 'Electronicos para la limpieza de ropa',
        ]);
    }
}
