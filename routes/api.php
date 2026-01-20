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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('students', StudentController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('appointment_services', AppointmentServiceController::class);
Route::apiResource('categorys', CategoryController::class);
Route::apiResource('clients', ClientController::class);
Route::apiResource('consumables', ConsumableController::class);
Route::apiResource('equipments', EquipmentController::class);
Route::apiResource('groups', GroupController::class);
Route::apiResource('schedules', ScheduleController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('shifts', ShiftController::class);
Route::apiResource('student_consumables', StudentConsumableController::class);
Route::apiResource('student_equipments', StudentEquipmentController::class);
Route::apiResource('users', UserController::class);
