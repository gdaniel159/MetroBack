<?php

namespace App\Http\Controllers;

use App\Models\ShippersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShippersController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $shippers = ShippersModel::with('orders')->get();
        return response()->json($shippers);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'compañia_nombre' => 'required',
                'telefono' => 'required'
                // Otros campos necesarios para crear el transportista
            ]);

            $shipper = ShippersModel::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Transportista creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el transportista: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $shipper = ShippersModel::find($id);
            if (!$shipper) {
                return response()->json(['error' => 'Transportista no encontrado'], 404);
            }

            $request->validate([
                'compañia_nombre' => 'required',
                'telefono' => 'required'
                // Otros campos necesarios para actualizar el transportista
            ]);

            $shipper->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Transportista actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el transportista: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $shipper = ShippersModel::find($id);
            if (!$shipper) {
                return response()->json(['error' => 'Transportista no encontrado'], 404);
            }

            // Verificar si hay pedidos asociados a este transportista
            $ordersCount = $shipper->orders->count();
            if ($ordersCount > 0) {
                return response()->json(['error' => 'No se puede eliminar el transportista. Tiene pedidos asociados.'], 400);
            }

            $shipper->delete();
            DB::commit();
            return response()->json(['message' => 'Transportista eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el transportista: ' . $e->getMessage()], 500);
        }
    }
}
