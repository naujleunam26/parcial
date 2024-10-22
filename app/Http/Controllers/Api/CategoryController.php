<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Obtener todas las categorías
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // Crear una nueva categoría
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return response()->json($category, 201);
    }

    // Mostrar una categoría específica
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    // Actualizar una categoría
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category, 200);
    }

    // Eliminar una categoría
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
