<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;

// Rutas para productos y categorías (sin protección de middleware)
Route::apiResource('categories', CategoryController::class);

// Rutas de autenticación (login y registro) fuera del middleware auth:sanctum
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);  // Ruta de login desde el AuthController

// Rutas protegidas por auth:sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Cerrar sesión
    Route::post('/logout', function (Request $request) {
        // Elimina el token actual del usuario
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente',
        ]);
    });
    
    // Obtener el usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rutas protegidas de productos
    Route::apiResource('products', ProductController::class);
});
