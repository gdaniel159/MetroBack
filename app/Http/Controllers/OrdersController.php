<?php

namespace App\Http\Controllers;

use App\Models\OrdersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $orders = OrdersModel::with('shippers', 'customers', 'employees', 'orders_details')->get();
        return response()->json($orders);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'fecha_orden' => 'required',
                'fecha_requirimiento' => 'required',
                'fecha_envio' => 'required',
                'vio_envia' => 'required',
                'transporte' => 'required',
                'nombre_envio' => 'required',
                'envio_direccion' => 'required',
                'envio_region' => 'required',
                'envio_codigo_postal' => 'required',
                'envio_pais' => 'required',
                'customers_id' => 'required',
                'employee_id' => 'required',
                // Otros campos necesarios para crear la orden
            ]);

            $order = OrdersModel::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Orden creada correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear la orden: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $order = OrdersModel::find($id);
            if (!$order) {
                return response()->json(['error' => 'Orden no encontrada'], 404);
            }

            $request->validate([
                'fecha_orden' => 'required',
                'fecha_requirimiento' => 'required',
                'fecha_envio' => 'required',
                'vio_envia' => 'required',
                'transporte' => 'required',
                'nombre_envio' => 'required',
                'envio_direccion' => 'required',
                'envio_region' => 'required',
                'envio_codigo_postal' => 'required',
                'envio_pais' => 'required',
                'customers_id' => 'required',
                'employee_id' => 'required',
                // Otros campos necesarios para actualizar la orden
            ]);

            $order->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Orden actualizada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar la orden: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $order = OrdersModel::find($id);
            if (!$order) {
                return response()->json(['error' => 'Orden no encontrada'], 404);
            }

            // Verificar si hay detalles de órdenes asociados a esta orden
            $orderDetailsCount = $order->orders_details->count();
            if ($orderDetailsCount > 0) {
                return response()->json(['error' => 'No se puede eliminar la orden. Tiene detalles de órdenes asociados.'], 400);
            }

            $order->delete();
            DB::commit();
            return response()->json(['message' => 'Orden eliminada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar la orden: ' . $e->getMessage()], 500);
        }
    }
}
