<?php

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
use App\Http\Controllers\StudentConsumableController;
use App\Http\Controllers\StudentEquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('appointments/by-date', [AppointmentController::class, 'byDate'])->middleware('auth:sanctum');
Route::get('appointments/by-student', [AppointmentController::class, 'byStudent'])->middleware('auth:sanctum');
Route::get('/appointments/occupancy/month', [AppointmentController::class, 'monthOccupancy'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('students', StudentController::class)->middleware('auth:sanctum');
Route::apiResource('appointments', AppointmentController::class)->middleware('auth:sanctum');
Route::apiResource('appointment_services', AppointmentServiceController::class)->middleware('auth:sanctum');
Route::apiResource('categorys', CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('clients', ClientController::class)->middleware('auth:sanctum');
Route::apiResource('consumables', ConsumableController::class)->middleware('auth:sanctum');
Route::apiResource('equipments', EquipmentController::class)->middleware('auth:sanctum');
Route::apiResource('groups', GroupController::class)->middleware('auth:sanctum');
Route::apiResource('schedules', ScheduleController::class)->middleware('auth:sanctum');
Route::apiResource('services', ServiceController::class)->middleware('auth:sanctum');
Route::apiResource('shifts', ShiftController::class)->middleware('auth:sanctum');
Route::apiResource('student_consumables', StudentConsumableController::class)->middleware('auth:sanctum');
Route::apiResource('student_equipments', StudentEquipmentController::class)->middleware('auth:sanctum');
Route::apiResource('users', UserController::class)->middleware('auth:sanctum');


//Route to get the profile of the authenticated user
Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth:sanctum');
//Route to get the progress of the authenticated user
Route::get('/profile/progress', [UserController::class, 'progress'])
    ->middleware('auth:sanctum');

Route::apiResource('equipments', EquipmentController::class);
Route::apiResource('student_equipments', StudentEquipmentController::class)->except(['destroy']);

Route::get('student_equipments-active', [StudentEquipmentController::class, 'active']);
Route::put('student_equipments/{id}/finish', [StudentEquipmentController::class, 'finish']);
