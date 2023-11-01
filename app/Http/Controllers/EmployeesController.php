<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos con territorios asociados
    public function get()
    {
        $employees = Employees::with('employees_territories')->get();
        return response()->json($employees);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $employee = Employees::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Empleado creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el empleado: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employee = Employees::find($id);
            if (!$employee) {
                return response()->json(['error' => 'Empleado no encontrado'], 404);
            }
            $employee->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Empleado actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el empleado: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $employee = Employees::find($id);
            if (!$employee) {
                return response()->json(['error' => 'Empleado no encontrado'], 404);
            }
            $employee->delete();
            DB::commit();
            return response()->json(['message' => 'Empleado eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el empleado: ' . $e->getMessage()], 500);
        }
    }
}
