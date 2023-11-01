<?php

namespace App\Http\Controllers;

use App\Models\Customer_CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Customer_CustomerController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $customerCustomers = Customer_CustomerModel::with('customer_demographics', 'customers')->get();
        return response()->json($customerCustomers);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'customer_type_id' => 'required',
                'customer_id' => 'required',
            ]);

            $customerCustomer = Customer_CustomerModel::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Relación cliente creada correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear la relación cliente: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customerCustomer = Customer_CustomerModel::find($id);
            if (!$customerCustomer) {
                return response()->json(['error' => 'Relación cliente no encontrada'], 404);
            }

            $request->validate([
                'customer_type_id' => 'required',
                'customer_id' => 'required',
            ]);

            $customerCustomer->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Relación cliente actualizada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar la relación cliente: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customerCustomer = Customer_CustomerModel::find($id);
            if (!$customerCustomer) {
                return response()->json(['error' => 'Relación cliente no encontrada'], 404);
            }

            $customerCustomer->delete();
            DB::commit();
            return response()->json(['message' => 'Relación cliente eliminada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar la relación cliente: ' . $e->getMessage()], 500);
        }
    }
}
