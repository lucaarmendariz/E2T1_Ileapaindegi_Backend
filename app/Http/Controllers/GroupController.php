<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return response()->json(Group::with('students','schedules')->get());
    }

    public function show($id)
    {
        return response()->json(Group::with('students','schedules')->findOrFail($id));
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
        $group->update($request->all());
        return response()->json($group);
    }

    public function destroy($id)
    {
        Group::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
