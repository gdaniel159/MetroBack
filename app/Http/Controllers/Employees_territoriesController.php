<?php
namespace App\Http\Controllers;
use App\Models\Employees_territories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Employees_territoriesController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $employeesTerritories = Employees_territories::with('employees')->get();
        return response()->json($employeesTerritories);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employees_id' => 'required|exists:employees,id',
                'territory_id' => 'required'
            ]);

            $employeeTerritory = Employees_territories::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Territorio de empleado creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el territorio de empleado: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employeeTerritory = Employees_territories::find($id);
            if (!$employeeTerritory) {
                return response()->json(['error' => 'Territorio de empleado no encontrado'], 404);
            }

            $request->validate([
                'employees_id' => 'required|exists:employees,id',
                'territory_id' => 'required'
            ]);

            $employeeTerritory->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Territorio de empleado actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el territorio de empleado: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employeeTerritory = Employees_territories::find($id);
            if (!$employeeTerritory) {
                return response()->json(['error' => 'Territorio de empleado no encontrado'], 404);
            }

            $employeeTerritory->delete();
            DB::commit();
            return response()->json(['message' => 'Territorio de empleado eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el territorio de empleado: ' . $e->getMessage()], 500);
        }
    }
}
