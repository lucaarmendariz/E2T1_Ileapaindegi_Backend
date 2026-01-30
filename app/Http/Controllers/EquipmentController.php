<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\StudentEquipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::with('studentEquipments')->get();

        // Puedes agregar el atributo is_occupied manualmente
        $equipments->each(function ($equipment) {
            $equipment->is_occupied = $equipment->is_occupied; // atributo accesor
        });

        return response()->json($equipments);
    }

    public function show($id)
    {
        return response()->json(Equipment::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $equipment = Equipment::create($request->all());
        return response()->json($equipment, 201);
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

    public function getOccupiedEquipmentsWithStudents()
{
    $now = Carbon::now();

    $occupied = StudentEquipment::with(['student', 'equipment'])
        ->where('start_datetime', '<=', $now)
        ->where(function ($query) use ($now) {
            $query->whereNull('end_datetime')
                  ->orWhere('end_datetime', '>', $now);
        })
        ->get();

    return response()->json($occupied);
}
}
