<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Customer_demographicsController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
      
    }
    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();

    }

    // PUT - Actualizar datos

   public function update(Request $request, $id)
    {
        DB::beginTransaction();
       
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
    }
}
