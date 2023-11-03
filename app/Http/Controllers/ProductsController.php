<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $products = Products::with('categories','suppliers')->get();
        return response()->json($products);
    }

    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $categoria_id =  $request->categoria_id;
            $supplier_id = $request->supplier_id;

            $categoria = Categories::where('id',$categoria_id)->first();
            $supplier = Suppliers::where('id',$supplier_id)->first();

            $products = Products::updateOrcreate([
                'nombre_producto' => $request->nombre_producto,
                'categoria_id' => $categoria->id,
                'supplier_id' => $supplier->id,
                'cantidad_unidad' => $request->cantidad_unidad,
                'precio_unidad' => $request->precio_unidad,
                'unidades_stock' => $request->unidades_stock,
                'unidades_orden' => $request->unidades_orden,
                'reorden_nivel' => $request->orden_nivel,
            ]);

            DB::commit();
            return response()->json(["resp" => "Producto Creado Correctamente"], 200);

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
