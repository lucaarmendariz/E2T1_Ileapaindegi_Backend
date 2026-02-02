<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments'; // <- forzar el plural correcto
    // Equipment.php

    protected $appends = ['is_occupied'];

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

    // Equipos ocupados: tiene asignaciones activas (sin fecha de fin o con fin en el futuro)
    public function getIsOccupiedAttribute()
    {
        return $this->studentEquipments()
            ->whereNull('end_datetime')
            ->orWhere('end_datetime', '>', now())
            ->exists();
    }
}
