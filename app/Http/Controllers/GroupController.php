<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return response()->json(Group::with('students', 'schedules')->get());
    }

    public function show($id)
    {
        return response()->json(Group::with('students', 'schedules')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $group = Group::create($request->all());
        return response()->json($group, 201);
    }

    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        $group->update([
            'name' => $request->name
        ]);

        // Si vienen estudiantes, los sincronizamos
        if ($request->has('students')) {
            $studentIds = collect($request->students)
                ->pluck('student_id')
                ->toArray();

            // Quitamos grupo a los estudiantes que ya no están
            \App\Models\Student::where('group_id', $group->id)
                ->whereNotIn('id', $studentIds)
                ->update(['group_id' => null]);

            // Asignamos grupo a los nuevos
            \App\Models\Student::whereIn('id', $studentIds)
                ->update(['group_id' => $group->id]);
        }

        return response()->json(
            $group->load('students')
        );
    }


    public function destroy($id)
    {
        Group::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
