<?php
        use App\Http\Controllers\ProductController;
        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\AuthController;
        use App\Models\User;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Hash;
        use Illuminate\Validation\ValidationException;
        use App\Http\Controllers\Api\CategoryController;
        


            Route::apiResource('products', ProductController::class);
            Route::apiResource('categories', CategoryController::class);

            


            Route::middleware('auth:sanctum')->group(function () {
            Route::post('/register', [AuthController::class, 'register']);
            Route::post('/login', [AuthController::class, 'login']);
            });

            Route::post('/login', function (Request $request) {
                // Validar el email y password
                $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);
            
                $user = User::where('email', $request->email)->first();
            
                if (!$user || !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'email' => ['Las credenciales proporcionadas no coinciden con nuestros registros.'],
                    ]);
                }
            
                // Crear un token de acceso personal
                $token = $user->createToken('auth_token')->plainTextToken;
            
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ]);
            });

            Route::post('/logout', function (Request $request) {
                // Elimina el token actual del usuario
                $request->user()->currentAccessToken()->delete();
            
                return response()->json([
                    'message' => 'Sesión cerrada exitosamente',
                ]);
            })->middleware('auth:sanctum');

            Route::middleware('auth:sanctum')->group(function () {
                Route::get('/products', [ProductController::class, 'index']);
                Route::post('/products', [ProductController::class, 'store']);
                Route::get('/products/{id}', [ProductController::class, 'show']);
                Route::put('/products/{id}', [ProductController::class, 'update']);
                Route::delete('/products/{id}', [ProductController::class, 'destroy']);
            });
            