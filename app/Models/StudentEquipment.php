<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEquipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'equipment_id',
        'start_datetime',
        'end_datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    protected $table = 'student_equipments';

}
