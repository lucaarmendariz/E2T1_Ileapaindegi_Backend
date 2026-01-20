<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function studentConsumables()
    {
        return $this->hasMany(StudentConsumable::class);
    }
}
