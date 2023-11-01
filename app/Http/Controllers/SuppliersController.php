<?php

namespace App\Http\Controllers;

use App\Models\SuppliersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $suppliers = SuppliersModel::with('products')->get();
        return response()->json($suppliers);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'nombre_compañia' => 'required',
                'nombre_contacto' => 'required',
                // Otros campos necesarios para crear el proveedor
            ]);

            $supplier = SuppliersModel::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Proveedor creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el proveedor: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $supplier = SuppliersModel::find($id);
            if (!$supplier) {
                return response()->json(['error' => 'Proveedor no encontrado'], 404);
            }

            $request->validate([
                'nombre_compañia' => 'required',
                'nombre_contacto' => 'required',
                // Otros campos necesarios para actualizar el proveedor
            ]);

            $supplier->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Proveedor actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el proveedor: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $supplier = SuppliersModel::find($id);
            if (!$supplier) {
                return response()->json(['error' => 'Proveedor no encontrado'], 404);
            }

            // Verificar si hay productos asociados a este proveedor
            $productsCount = $supplier->products->count();
            if ($productsCount > 0) {
                return response()->json(['error' => 'No se puede eliminar el proveedor. Tiene productos asociados.'], 400);
            }

            $supplier->delete();
            DB::commit();
            return response()->json(['message' => 'Proveedor eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el proveedor: ' . $e->getMessage()], 500);
        }
    }
}
