<?php

namespace App\Http\Controllers;

use App\Models\TerritoriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TerritoriesController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $territories = TerritoriesModel::with('region')->get();
        return response()->json($territories);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'descripcion' => 'required',
                'region_id' => 'required|exists:region,id'
                
            ]);

            $territory = TerritoriesModel::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Territorio creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el territorio: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $territory = TerritoriesModel::find($id);
            if (!$territory) {
                return response()->json(['error' => 'Territorio no encontrado'], 404);
            }

            $request->validate([
                'descripcion' => 'required',
                'region_id' => 'required|exists:region,id'
                
            ]);

            $territory->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Territorio actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el territorio: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $territory = TerritoriesModel::find($id);
            if (!$territory) {
                return response()->json(['error' => 'Territorio no encontrado'], 404);
            }

            $territory->delete();
            DB::commit();
            return response()->json(['message' => 'Territorio eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el territorio: ' . $e->getMessage()], 500);
        }
    }
}
