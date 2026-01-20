<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        return response()->json(Shift::with('student','schedule')->get());
    }

    public function show($id)
    {
        return response()->json(Shift::with('student','schedule')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required|exists:students,id',
            'schedule_id'=>'required|exists:schedules,id'
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
