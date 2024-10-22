<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Controller
{
    /**
     * Registro de un nuevo usuario.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Asegúrate de encriptar la contraseña
        ]);

        return response()->json($user, 201);
    }

    /**
     * Inicio de sesión del usuario.
     */
    public function login(Request $request)
    {
        // Validar los datos del login
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciales no válidas'
            ], 401);
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Generar el token con Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        // Retornar el token y el usuario en la respuesta
        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    /**
     * Cerrar sesión del usuario (logout).
     */
    public function logout(Request $request)
    {
        // Eliminar todos los tokens del usuario autenticado
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}
