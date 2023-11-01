<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $products = Products::with('categories', 'suppliers', 'order_details')->get();
        return response()->json($products);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'nombre_producto' => 'required',
                'cantidad_unidad' => 'required',
                'nombre_categoria' => 'required',
                'precio_unidad' => 'required',
                'unidades_stock' => 'required',
                // Otros campos necesarios para crear el producto
            ]);

            $product = Products::create($request->all());
            DB::commit();
            return response()->json(['message' => 'Producto creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al crear el producto: ' . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Products::find($id);
            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            $request->validate([
                'nombre_producto' => 'required',
                'cantidad_unidad' => 'required',
                'nombre_categoria' => 'required',
                'precio_unidad' => 'required',
                'unidades_stock' => 'required',
                // Otros campos necesarios para actualizar el producto
            ]);

            $product->update($request->all());
            DB::commit();
            return response()->json(['message' => 'Producto actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al actualizar el producto: ' . $e->getMessage()], 500);
        }
    }

    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Products::find($id);
            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado'], 404);
            }

            // Verificar si hay detalles de órdenes asociados a este producto
            $orderDetailsCount = $product->order_details->count();
            if ($orderDetailsCount > 0) {
                return response()->json(['error' => 'No se puede eliminar el producto. Tiene detalles de órdenes asociados.'], 400);
            }

            $product->delete();
            DB::commit();
            return response()->json(['message' => 'Producto eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Error al eliminar el producto: ' . $e->getMessage()], 500);
        }
    }
}
