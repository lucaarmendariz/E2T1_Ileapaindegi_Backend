<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json(
            Appointment::with(['student', 'client', 'services.service'])->get()
        );
    }

    public function show($id)
    {
        return response()->json(
            Appointment::with(['student', 'client', 'services.service'])
                ->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'student_id' => 'nullable|exists:students,id',
            'client_id' => 'required|exists:clients,id',
            'seat' => 'required',
            'services' => 'required|array',
            'services.*' => 'exists:services,id'
        ]);

        $appointment = Appointment::create([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'student_id' => $request->student_id,
            'client_id' => $request->client_id,
            'seat' => $request->seat,
            'comments' => $request->comments
        ]);

        if ($request->has('services')) {
            foreach ($request->services as $serviceId) {
                $appointment->services()->create([
                    'service_id' => $serviceId
                ]);
            }
        }

        return response()->json(
            $appointment->load(['student', 'client', 'services.service']),
            201
        );
    }

    public function byDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = $request->query('date');

        $appointments = Appointment::whereDate('date', $date)
            ->with(['services.service'])
            ->get(['id', 'seat', 'date', 'start_time', 'end_time', 'comments']);

        return response()->json($appointments);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        $request->validate([
            'date' => 'sometimes|required|date',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i',
            'student_id' => 'nullable|exists:students,id',
            'client_id' => 'sometimes|required|exists:clients,id',
            'seat' => 'sometimes|required',
            'services' => 'sometimes|array',
            'services.*' => 'exists:services,id'
        ]);

        $appointment->update($request->only([
            'date', 'start_time', 'end_time', 
            'student_id', 'client_id', 'seat', 'comments'
        ]));

        if ($request->has('services')) {
            $appointment->services()->delete();
            
            foreach ($request->services as $serviceId) {
                $appointment->services()->create([
                    'service_id' => $serviceId
                ]);
            }
        }

        return response()->json(
            $appointment->load(['student', 'client', 'services.service'])
        );
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(null, 204);
    }
}