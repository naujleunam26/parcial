<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // Obtener todos los productos
    public function index()
    {
        return response()->json(Product::with('category')->get(), 200);  // Incluir la relación con categorías
    }

    // Crear un nuevo producto
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($product, 201);
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        return response()->json($product->load('category'), 200);
    }

    // Actualizar un producto
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json($product, 200);
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
