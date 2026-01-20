<?php

namespace App\Http\Controllers;

use App\Models\StudentEquipment;
use Illuminate\Http\Request;

class StudentEquipmentController extends Controller
{
    public function index()
    {
        return response()->json(StudentEquipment::with('student','equipment')->get());
    }

    public function show($id)
    {
        return response()->json(StudentEquipment::with('student','equipment')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required|exists:students,id',
            'equipment_id'=>'required|exists:equipments,id',
            'start_datetime'=>'required|date',
            'end_datetime'=>'required|date|after_or_equal:start_datetime'
        ]);

        $se = StudentEquipment::create($request->all());
        return response()->json($se, 201);
    }

    public function update(Request $request, $id)
    {
        $se = StudentEquipment::findOrFail($id);
        $se->update($request->all());
        return response()->json($se);
    }

    public function destroy($id)
    {
        StudentEquipment::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
