<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments'; // <- forzar el plural correcto
    protected $fillable = [
        'name', 
        'label', 
        'description',
        'brand'
    ];

    public function studentEquipments()
    {
        return $this->hasMany(StudentEquipment::class);
    }
}
