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
        // Solo usuarios que no estén borrados
        $users = User::whereNull('deleted_at')->get();
        return response()->json($users);
    }


    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }


    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|string|max:1'
        ]);

        // Asegúrate de no incluir los usuarios eliminados
        $existingUser = User::where('email', $request->email)->whereNull('deleted_at')->first();

        if ($existingUser) {
            return response()->json(['message' => 'Ya existe un usuario con este email'], 422);
        }

        // Crear el nuevo usuario
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
    $user = User::findOrFail($id);

    // Eliminar el student relacionado si existe
    if ($user->student) {
        $user->student->delete();
    }

    $user->delete();

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

        $student = $user->student;
        if (!$student) {
            return response()->json(['servicios' => []]);
        }

        // Traer todas las citas finalizadas del alumno
        $appointments = $student->appointments()
            ->whereDate('date', '<=', now())
            ->with('services.service')
            ->get();

        // Contar cuántas veces se ha completado cada servicio
        $serviceCounts = [];
        foreach ($appointments as $appointment) {
            foreach ($appointment->services as $appointmentService) {
                if ($appointmentService->service) {
                    $id = $appointmentService->service->id;
                    $serviceCounts[$id] = ($serviceCounts[$id] ?? 0) + 1;
                }
            }
        }

        // Traer todos los servicios posibles
        $allServices = \App\Models\Service::all();

        // Generar array final con completado y cantidad
        $servicios = $allServices->map(function ($service) use ($serviceCounts) {
            $cantidad = $serviceCounts[$service->id] ?? 0;
            return [
                'id' => $service->id,
                'nombre' => $service->name,
                'completado' => $cantidad > 0,
                'cantidad_completada' => $cantidad
            ];
        });


        return response()->json(['servicios' => $servicios]);
    }
}
