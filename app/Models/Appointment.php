<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'seat',
        'start_time',
        'end_time',
        'comments',
        'student_id',
        'client_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Appointment.php
    public function services()
    {
        return $this->hasMany(AppointmentService::class);
    }

}
