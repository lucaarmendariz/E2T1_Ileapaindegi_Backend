<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'surnames',
        'group_id',
        'user_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function consumables()
    {
        return $this->hasMany(StudentConsumable::class);
    }

    public function equipments()
    {
        return $this->hasMany(StudentEquipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
