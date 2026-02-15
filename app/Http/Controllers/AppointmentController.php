<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    /**
     * Obtener citas de un estudiante específico
     */
    public function byStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $studentId = $request->query('student_id');

        $appointments = Appointment::where('student_id', $studentId)
            ->with(['client', 'services.service'])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return response()->json($appointments);
    }

    /**
     * Obtener citas por fecha con estudiantes libres
     */
    public function byDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $date = $request->query('date');
        $dayOfWeek = Carbon::parse($date)->dayOfWeek;
        $dayNames = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        $dayName = $dayNames[$dayOfWeek];

        // Obtener estudiantes que tienen horario ese día
        $students = \App\Models\Student::whereHas('group.schedules', function ($query) use ($dayName, $date) {
            $query->where('day', $dayName)
                ->where(function ($q) use ($date) {
                    $q->whereNull('start_date')
                        ->orWhere('start_date', '<=', $date);
                })
                ->where(function ($q) use ($date) {
                    $q->whereNull('end_date')
                        ->orWhere('end_date', '>=', $date);
                });
        })->get(['id', 'name']);

        // Obtener citas del día
        $appointments = Appointment::whereDate('date', $date)
            ->with(['services.service', 'student'])
            ->get();

        return response()->json([
            'appointments' => $appointments,
            'students' => $students,
            'available_seats' => $students->count()
        ]);
    }

    /**
     * Obtener ocupación mensual 
     */
    public function monthOccupancy(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'month' => 'required|integer|min:1|max:12'
        ]);

        $year = $request->query('year');
        $month = $request->query('month');

        // Obtener todas las citas del mes
        $appointments = Appointment::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get(['date', 'start_time', 'end_time']);

        if ($appointments->isEmpty()) {
            return response()->json([]);
        }

        // Agrupar por día y calcular ocupación
        $occupancy = [];
        
        foreach ($appointments as $appointment) {
            $dateKey = Carbon::parse($appointment->date)->format('Y-m-d');
            
            if (!isset($occupancy[$dateKey])) {
                $occupancy[$dateKey] = [
                    'appointments_count' => 0,
                    'total_hours' => 0,
                ];
            }
            
            $occupancy[$dateKey]['appointments_count']++;
            
            // Calcular horas de la cita
            $start = Carbon::parse($appointment->date . ' ' . $appointment->start_time);
            $end = Carbon::parse($appointment->date . ' ' . $appointment->end_time);
            $hours = $end->diffInMinutes($start, true) / 60;
            
            $occupancy[$dateKey]['total_hours'] += $hours;
        }

        // Calcular niveles de ocupación
        $result = [];
        foreach ($occupancy as $date => $data) {
            // 5 sillones * 4 horas = 20 horas
            $maxCapacity = 5 * 4;
            $occupancyRate = min(100, ($data['total_hours'] / $maxCapacity) * 100);
            
            $level = 'empty';
            if ($occupancyRate >= 80) {
                $level = 'high';
            } elseif ($occupancyRate >= 50) {
                $level = 'medium';
            } elseif ($occupancyRate > 0) {
                $level = 'low';
            }
            
            $result[$date] = [
                'appointments_count' => $data['appointments_count'],
                'total_hours' => round($data['total_hours'], 2),
                'occupancy_rate' => round($occupancyRate, 2),
                'level' => $level
            ];
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'student_id' => 'nullable|exists:students,id',
            'client_id' => 'required|exists:clients,id',
            'seat' => 'required|integer',
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

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'date' => 'sometimes|required|date',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i',
            'student_id' => 'nullable|exists:students,id',
            'client_id' => 'sometimes|required|exists:clients,id',
            'seat' => 'sometimes|required|integer',
            'services' => 'sometimes|array',
            'services.*' => 'exists:services,id'
        ]);

        $appointment->update($request->only([
            'date',
            'start_time',
            'end_time',
            'student_id',
            'client_id',
            'seat',
            'comments'
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