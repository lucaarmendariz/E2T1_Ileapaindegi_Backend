<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Student;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        // Traemos los turnos con estudiante y schedule
        return response()->json(Shift::with('student', 'schedule.group')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'  => 'required|exists:students,id',
            'type'        => 'required|string',
            'date'       => 'required|date'
        ]);

        $shift = Shift::create($request->all());
        return response()->json($shift, 201);
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::findOrFail($id);
        $shift->update($request->all());
        return response()->json($shift);
    }

    public function destroy($id)
    {
        Shift::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
