<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentConsumableController;
use App\Http\Controllers\StudentEquipmentController;

Route::post('/login', [AuthController::class, 'login']);

// Sarbidea mugatuta duten rutak:
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Logeatutako erabiltzailearen datuak hartu
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/students', StudentController::class);
    
    Route::apiResource('/appointments', AppointmentController::class);
    Route::get('/appointments/by-date', [AppointmentController::class, 'byDate']);
    Route::get('/appointments/by-student', [AppointmentController::class, 'byStudent']);

    Route::apiResource('/appointment_services', AppointmentServiceController::class);

    Route::apiResource('/categories', CategoryController::class);

    Route::apiResource('/clients', ClientController::class);

    Route::apiResource('/consumables', ConsumableController::class);

    Route::apiResource('/equipments', controller: EquipmentController::class);

    Route::apiResource('/groups', GroupController::class);

    Route::apiResource('/schedules', ScheduleController::class);

    Route::apiResource('/services', ServiceController::class);
    
    Route::apiResource('/shifts', ShiftController::class);

    Route::apiResource('/student-consumables', StudentConsumableController::class);

    Route::apiResource('/student-equipments', StudentEquipmentController::class)
        ->except(['destroy']);
    Route::get('/student-equipments/active', [StudentEquipmentController::class, 'active']);
    Route::put('/student-equipments/{id}/finish', [StudentEquipmentController::class, 'finish']);
    
    Route::apiResource('/users', UserController::class);

    // Jasotzeko autentikatutako erabiltzailearen informazioa
    Route::get('/profile', [UserController::class, 'profile']);
    // Jasotzeko autentikatutako erabiltzailearen progresoa
    Route::get('/profile/progress', [UserController::class, 'progress']);
});