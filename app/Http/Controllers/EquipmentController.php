<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return response()->json(
            Equipment::all()
        );
    }

    public function show($id)
    {
        return response()->json(
            Equipment::findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        return response()->json(
            Equipment::create($request->all()),
            201
        );
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->all());

        return response()->json($equipment);
    }

    public function destroy($id)
    {
        Equipment::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
