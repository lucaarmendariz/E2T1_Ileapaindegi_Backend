<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json(Schedule::get());
    }

    public function show($id)
    {
        return response()->json(Schedule::with('group')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required|string',
            'group_id' => 'required|exists:groups,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $schedule = Schedule::create($request->all());
        return response()->json($schedule, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'day' => 'required|string',
            'group_id' => 'required|exists:groups,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());
        return response()->json($schedule);
    }

    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
