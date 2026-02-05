<?php

namespace App\Http\Controllers;

use App\Models\StudentEquipment;
use Illuminate\Http\Request;

class StudentEquipmentController extends Controller
{
    public function index()
    {
        return response()->json(
            StudentEquipment::with(['student', 'equipment'])->get()
        );
    }

    /**
     * SOLO asignaciones activas
     */
    public function active()
    {
        return response()->json(
            StudentEquipment::with(['student', 'equipment'])
                ->where(function ($query) {
                    $query->whereNull('deleted_at')
                        ->orWhere('deleted_at', '>', now());
                })
                ->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'equipment_id' => 'required|exists:equipments,id',
            'start_datetime' => 'required|date',
        ]);

        $occupied = StudentEquipment::where('equipment_id', $request->equipment_id)
            ->where(function ($query) {
                $query->whereNull('end_datetime')
                    ->orWhere('end_datetime', '>', now());
            })
            ->exists();

        if ($occupied) {
            return response()->json([
                'message' => 'El equipamiento ya está ocupado'
            ], 409);
        }



        $studentEquipment = StudentEquipment::create([
            'student_id' => $request->student_id,
            'equipment_id' => $request->equipment_id,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => null
        ]);

        return response()->json(
            $studentEquipment->load('student'),
            201
        );
    }

    /**
     * Finalizar uso (NO borrar)
     */
    public function finish($id)
    {
        $se = StudentEquipment::findOrFail($id);

        $se->delete(); // 👈 Soft delete real

        return response()->json(
            $se->load(['student', 'equipment'])
        );
    }

}
