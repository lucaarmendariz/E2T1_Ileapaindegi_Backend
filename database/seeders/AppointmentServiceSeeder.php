<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppointmentService;
use App\Models\Appointment;
use App\Models\Service;

class AppointmentServiceSeeder extends Seeder
{
    public function run(): void
    {
        $appointment = Appointment::first();
        $service = Service::first();

        AppointmentService::create([
            'appointment_id' => $appointment->id,
            'service_id' => $service->id,
            'comments' => 'Servicio principal de la cita'
        ]);

        // Otro ejemplo
        $service2 = Service::skip(1)->first(); // segundo servicio si existe
        if ($service2) {
            AppointmentService::create([
                'appointment_id' => $appointment->id,
                'service_id' => $service2->id,
                'comments' => 'Servicio adicional'
            ]);
        }
    }
}
