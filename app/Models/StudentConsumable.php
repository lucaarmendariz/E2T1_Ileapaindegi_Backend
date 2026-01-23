<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentConsumable extends Model
{
    protected $fillable = [
        'student_id',
        'consumable_id',
        'date',
        'quantity'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function consumable()
    {
        return $this->belongsTo(Consumable::class);
    }
    protected $table = 'student_consumables';
}
