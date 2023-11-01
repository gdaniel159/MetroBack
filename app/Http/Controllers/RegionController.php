<?php

namespace App\Http\Controllers;

use App\Models\RegionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $regions = RegionModel::with('territories')->get();
        return response()->json($regions);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'descripcion' => 'required'
                // Otros campos necesarios para crear la región
            ]);

            $region = RegionModel::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Región creada correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear la región: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $region = RegionModel::find($id);
            if (!$region) {
                return response()->json(['error' => 'Región no encontrada'], 404);
            }

            $request->validate([
                'descripcion' => 'required'
                // Otros campos necesarios para actualizar la región
            ]);

            $region->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Región actualizada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar la región: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $region = RegionModel::find($id);
            if (!$region) {
                return response()->json(['error' => 'Región no encontrada'], 404);
            }

            // Verificar si hay territorios asociados a esta región
            $territoriesCount = $region->territories->count();
            if ($territoriesCount > 0) {
                return response()->json(['error' => 'No se puede eliminar la región. Tiene territorios asociados.'], 400);
            }

            $region->delete();
            DB::commit();
            return response()->json(['message' => 'Región eliminada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar la región: ' . $e->getMessage()], 500);
        }
    }
}
