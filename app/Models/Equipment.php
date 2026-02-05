<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'label',
        'description',
        'brand'
    ];

    protected $appends = ['is_occupied'];

    public function studentEquipments(): HasMany
    {
        return $this->hasMany(StudentEquipment::class);
    }

    /**
     * Equipo ocupado si tiene alguna asignación activa
     */
    public function getIsOccupiedAttribute(): bool
    {
        return $this->studentEquipments()
            ->where(function ($query) {
                $query->whereNull('deleted_at')
                      ->orWhere('deleted_at', '>', now());
            })
            ->exists();
    }
}
