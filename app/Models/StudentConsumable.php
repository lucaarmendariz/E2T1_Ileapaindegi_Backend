<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentConsumable extends Model
{
    protected $fillable = [
        'student_id',
        'consumable_id',
        'start_datetime',
        'end_datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }
}
