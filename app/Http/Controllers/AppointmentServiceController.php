<?php

namespace App\Http\Controllers;

use App\Models\AppointmentService;
use Illuminate\Http\Request;

class AppointmentServiceController extends Controller
{
    public function index()
    {
        return response()->json(AppointmentService::with('appointment','service')->get());
    }

    public function show($id)
    {
        return response()->json(AppointmentService::with('appointment','service')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id'=>'required|exists:appointments,id',
            'service_id'=>'required|exists:services,id'
        ]);

        $service = AppointmentService::create($request->all());
        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $service = AppointmentService::findOrFail($id);
        $service->update($request->all());
        return response()->json($service);
    }

    public function destroy($id)
    {
        AppointmentService::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
