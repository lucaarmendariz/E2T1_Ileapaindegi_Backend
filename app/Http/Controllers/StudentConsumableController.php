<?php

namespace App\Http\Controllers;

use App\Models\StudentConsumable;
use Illuminate\Http\Request;

class StudentConsumableController extends Controller
{
    public function index()
    {
        return response()->json(StudentConsumable::with('student','consumable')->get());
    }

    public function show($id)
    {
        return response()->json(StudentConsumable::with('student','consumable')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required|exists:students,id',
            'consumable_id'=>'required|exists:consumables,id',
            'start_datetime'=>'required|date',
            'end_datetime'=>'required|date|after_or_equal:start_datetime'
        ]);

        $sc = StudentConsumable::create($request->all());
        return response()->json($sc, 201);
    }

    public function update(Request $request, $id)
    {
        $sc = StudentConsumable::findOrFail($id);
        $sc->update($request->all());
        return response()->json($sc);
    }

    public function destroy($id)
    {
        StudentConsumable::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
