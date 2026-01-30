<?php

namespace App\Http\Controllers;

use App\Models\StudentEquipment;
use Illuminate\Http\Request;

class StudentEquipmentController extends Controller
{
    public function index()
    {
        return response()->json(StudentEquipment::with('student', 'equipment')->get());
    }

    public function show($id)
    {
        return response()->json(StudentEquipment::with('student', 'equipment')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'equipment_id' => 'required|exists:equipments,id',
            'start_datetime' => 'required|date',
            // 'end_datetime' no requerido o puede ser null para asignación activa
        ]);

        // Verificar si el equipamiento está ocupado
        $occupied = StudentEquipment::where('equipment_id', $request->equipment_id)
            ->where(function ($query) {
                $query->whereNull('end_datetime')
                    ->orWhere('end_datetime', '>', now());
            })->exists();

        if ($occupied) {
            return response()->json(['error' => 'El equipamiento ya está ocupado'], 400);
        }

        $se = StudentEquipment::create([
            'student_id' => $request->student_id,
            'equipment_id' => $request->equipment_id,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => null // asignación activa
        ]);

        return response()->json($se, 201);
    }


    public function update(Request $request, $id)
    {
        $se = StudentEquipment::findOrFail($id);

        $request->validate([
            'end_datetime' => 'required|date|after_or_equal:' . $se->start_datetime,
            // otros campos si quieres permitir actualizar
        ]);

        $se->update([
            'end_datetime' => $request->end_datetime,
        ]);

        return response()->json($se);
    }


    public function destroy($id)
    {
        StudentEquipment::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
