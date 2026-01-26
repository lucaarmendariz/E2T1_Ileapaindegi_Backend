<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|string|max:1'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'rol' => 'sometimes|string|max:1'
        ]);

        $data = $request->only(['username', 'email', 'rol']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json($user);
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'name' => $user->username,
            'email' => $user->email,
            'rol' => $user->rol
        ]);
    }

    public function progress(Request $request)
{
    $user = $request->user();

    // Relación con el alumno
    $student = $user->student;

    if (!$student) {
        return response()->json(['servicios_completados' => []]);
    }

    // Obtener todas las citas finalizadas del alumno con sus servicios
    $appointments = $student->appointments()
        ->whereDate('date', '<=', now()) // solo citas finalizadas
        ->with('services.service')       // traer el servicio relacionado
        ->get();

    $completedServices = [];

    foreach ($appointments as $appointment) {
        foreach ($appointment->services as $appointmentService) {
            $service = $appointmentService->service;
            if ($service) {
                $completedServices[] = [
                    'id' => $service->id,
                    'nombre' => $service->name,
                ];
            }
        }
    }

    // Eliminar duplicados si el mismo servicio se hizo varias veces
    $completedServices = collect($completedServices)
        ->unique('id')
        ->values();

    return response()->json(['servicios_completados' => $completedServices]);
}



}
