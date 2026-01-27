<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'type',
        'data',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
