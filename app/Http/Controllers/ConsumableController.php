<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use Illuminate\Http\Request;

class ConsumableController extends Controller
{
    public function index()
    {
        return response()->json(Consumable::with('category')->get());
    }

    public function show($id)
    {
        return response()->json(Consumable::with('category')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'batch' => 'required|string',
            'brand' => 'required|string',
            'stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'expiration_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string'
        ]);

        $consumable = Consumable::create($request->all());

        // 👇 Cargar la categoría
        $consumable->load('category');

        return response()->json($consumable, 201);
    }


    public function update(Request $request, $id)
    {
        $consumable = Consumable::findOrFail($id);
        $consumable->update($request->all());

        // 👇 Cargar la categoría
        $consumable->load('category');

        return response()->json($consumable);
    }


    public function destroy($id)
    {
        Consumable::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
