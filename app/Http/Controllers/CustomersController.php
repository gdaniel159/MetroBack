<?php
namespace App\Http\Controllers;
use App\Models\CustomersModel;
use App\Models\Customer_CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CustomersController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $customers = CustomersModel::all();
        return response()->json($customers);
    }
    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = CustomersModel::create($request->all());

            // Crear registros relacionados en Customer_CustomerModel
            $customerCustomer = new Customer_CustomerModel();
            $customerCustomer->customer_id = $customer->id;
            $customerCustomer->campo_relacionado = $request->campo_relacionado; // Ajusta esto según tus campos
            $customerCustomer->save();

            DB::commit();
            return response()->json(['message' => 'Cliente y registros relacionados creados correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al crear el cliente: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customer = CustomersModel::find($id);
            if (!$customer) {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }
            $customer->update($request->all());

            // Actualizar registros relacionados en Customer_CustomerModel
            $customerCustomer = Customer_CustomerModel::where('customer_id', $customer->id)->first();
            if ($customerCustomer) {
                $customerCustomer->campo_relacionado = $request->campo_relacionado; // Ajusta esto según tus campos
                $customerCustomer->save();
            }

            DB::commit();
            return response()->json(['message' => 'Cliente y registros relacionados actualizados correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar el cliente: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customer = CustomersModel::find($id);
            if (!$customer) {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }

            // Eliminar registros relacionados en Customer_CustomerModel
            Customer_CustomerModel::where('customer_id', $customer->id)->delete();

            $customer->delete();
            DB::commit();
            return response()->json(['message' => 'Cliente y registros relacionados eliminados correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar el cliente: ' . $e->getMessage()], 500);
        }
    }
}
