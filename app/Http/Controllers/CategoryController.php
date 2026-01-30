<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar todas las categorías
    public function index()
    {
        return response()->json(Category::with('consumables')->get());
    }

    // Mostrar una categoría por id
    public function show($id)
    {
        return response()->json(Category::with('consumables')->findOrFail($id));
    }

    // Crear una nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // Actualizar categoría existente
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category);
    }

    // Eliminar categoría
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->consumables()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar la categoría porque tiene materiales asociados'
            ], 409);
        }

        $category->delete();
        return response()->json(null, 204);
    }

}
