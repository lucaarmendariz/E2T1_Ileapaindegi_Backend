<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $todos = Student::all();

        return response()->json([
            'success' => true,
            'data' => $todos,
        ], Response::HTTP_OK);
    }


    public function show($id)
    {
        return response()->json(Student::with('group','shifts','appointments','consumables','equipments')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surnames' => 'required|string',
        ]);

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
