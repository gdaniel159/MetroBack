<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // GET - Obtenemos todos los registros de la base de datos
    public function get()
    {
        $users = User::all();
        return response()->json($users);
    }
    // POST - Guardar datos
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            DB::commit();
            return response()->json(['message' => 'Usuario creado correctamente'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al crear el usuario: " . $e->getMessage()], 500);
        }
    }

    // PUT - Actualizar datos

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            if ($request->has('name')) {
                $user->name = $request->name;
            }
            if ($request->has('email')) {
                $user->email = $request->email;
            }
            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            DB::commit();
            return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al actualizar el usuario: " . $e->getMessage()], 500);
        }
    }


    // DELETE - Eliminar datos
    public function delete(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }
            $user->delete();
            DB::commit();
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => "Error al eliminar el usuario: " . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        // Obtener las credenciales del usuario desde la solicitud

        $credentials = $request->only('email', 'password');

        // Intentar autenticar al usuario

        if (auth()->attempt($credentials)) {

            // Autenticación exitosa

            $user = auth()->user();

            if ($user) {
                $verification_code = 1;
            }

            // Puedes realizar acciones adicionales aquí, como generar un token de acceso, si estás construyendo una API.

            return response()->json(['message' => 'Inicio de sesión exitoso', 'user' => $user, 'verification_code' => $verification_code], 200);
        } else {

            // Autenticación fallida

            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
    }
}
