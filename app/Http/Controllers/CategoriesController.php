<?php
namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }
    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = Categories::create([
                'nombre_categoria' => $request->nombre_categoria,
                'descripcion' => $request->descripcion,
                'foto' => $request->foto
            ]);
            DB::commit();
            return response()->json(['message' => 'Categoría creada correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al crear la categoría: " . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Categories::find($id);
            if (!$category) {
                return response()->json(['error' => 'Categoría no encontrada'], 404);
            }
            if ($request->has('nombre_categoria')) {
                $category->nombre_categoria = $request->nombre_categoria;
            }
            if ($request->has('descripcion')) {
                $category->descripcion = $request->descripcion;
            }
            if ($request->has('foto')) {
                $category->foto = $request->foto;
            }
            $category->save();
            DB::commit();
            return response()->json(['message' => 'Categoría actualizada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al actualizar la categoría: " . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Categories::find($id);
            if (!$category) {
                return response()->json(['error' => 'Categoría no encontrada'], 404);
            }
            // Verificar si hay productos asociados a esta categoría
            $productsCount = Products::where('categoria_id', $id)->count();
            if ($productsCount > 0) {
                return response()->json(['error' => 'No se puede eliminar la categoría. Tiene productos asociados.'], 400);
            }
            $category->delete();
            DB::commit();
            return response()->json(['message' => 'Categoría eliminada correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al eliminar la categoría: " . $e->getMessage()], 500);
        }
    } 
}
