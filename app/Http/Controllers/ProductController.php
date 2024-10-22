<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Mostrar un listado de productos.
     */
    public function index()
    {
        // Obtener productos paginados
        $products = Product::paginate(10); // Paginación de 10 productos
        return response()->json($products, 200);
    }

    /**
     * Almacenar un nuevo producto.
     */
    public function store(StoreProductRequest $request)
    {
        // Los datos ya están validados en StoreProductRequest
        $product = Product::create($request->validated());
    
        return response()->json($product, 201);
    }

    /**
     * Mostrar un producto específico.
     */
    public function show($id)
    {
        // Utilizamos findOrFail para manejar errores automáticamente
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }

    /**
     * Actualizar un producto específico.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json($product, 200);
    }

    /**
     * Eliminar un producto específico.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}
