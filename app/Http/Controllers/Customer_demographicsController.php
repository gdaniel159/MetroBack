<?php
namespace App\Http\Controllers;
use App\Models\Customers_demographicsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Customer_demographicsController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $customerDemographics = Customers_demographicsModel::with('customer_customer_demo')->get();
        return response()->json($customerDemographics);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customerDemographics = Customers_demographicsModel::create([
                'cliente_descripcion' => $request->cliente_descripcion
            ]);
            DB::commit();
            return response()->json(['message' => 'Datos de clientes demographics creados correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear los datos de clientes demographics: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customerDemographics = Customers_demographicsModel::find($id);
            if (!$customerDemographics) {
                return response()->json(['error' => 'Datos de clientes demographics no encontrados'], 404);
            }
            $customerDemographics->update([
                'cliente_descripcion' => $request->cliente_descripcion
            ]);
            DB::commit();
            return response()->json(['message' => 'Datos de clientes demographics actualizados correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar los datos de clientes demographics: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $customerDemographics = Customers_demographicsModel::find($id);
            if (!$customerDemographics) {
                return response()->json(['error' => 'Datos de clientes demographics no encontrados'], 404);
            }
            $customerDemographics->delete();
            DB::commit();
            return response()->json(['message' => 'Datos de clientes demographics eliminados correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar los datos de clientes demographics: ' . $e->getMessage()], 500);
        }
    }
}
