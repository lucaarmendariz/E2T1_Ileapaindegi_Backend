<?php
// hola
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json(Appointment::with('student','client','services')->get());
    }

    public function show($id)
    {
        return response()->json(Appointment::with('student','client','services')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'=>'required|date',
            'seat'=>'required|integer',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i',
            'student_id'=>'required|exists:students,id',
            'client_id'=>'required|exists:clients,id'
        ]);

        $appointment = Appointment::create($request->all());
        return response()->json($appointment, 201);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return response()->json($appointment);
    }

    public function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
