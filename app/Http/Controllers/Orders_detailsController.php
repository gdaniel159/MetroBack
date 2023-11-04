<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Orders_details;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Orders_detailsController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $ordersDetails = Orders_details::with('products', 'orders')->get();
        return response()->json($ordersDetails);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            $producto = Products::find($request->producto_id);
            $order = Orders::find($request->order_id);

            if ($producto && $order) {

                $orderDetails = Orders_details::updateOrcreate([
                    'precio_unitario' => $request->precio_unitario,
                    'cantidad' => $request->cantidad,
                    'producto_id' => $producto->id,
                    'orders_id' => $order->id,
                ]);

                DB::commit();

                return response()->json(['message' => 'Detalle de orden creado correctamente'], 201);
            } else {
                return response()->json(['message' => 'Error al crear el detalle de la orden, orden o producto inexistente']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el detalle de orden: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $orderDetails = Orders_details::find($id);
            if (!$orderDetails) {
                return response()->json(['error' => 'Detalle de orden no encontrado'], 404);
            }

            $request->validate([
                'precio_unitario' => 'required',
                'cantidad' => 'required',
                'producto_id' => 'required',
                'orders_id' => 'required',
            ]);

            $orderDetails->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Detalle de orden actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el detalle de orden: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $orderDetails = Orders_details::find($id);
            if (!$orderDetails) {
                return response()->json(['error' => 'Detalle de orden no encontrado'], 404);
            }

            $orderDetails->delete();
            DB::commit();
            return response()->json(['message' => 'Detalle de orden eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el detalle de orden: ' . $e->getMessage()], 500);
        }
    }
}
