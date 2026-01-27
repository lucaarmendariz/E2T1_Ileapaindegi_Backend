<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consumable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'batch',
        'brand',
        'stock',
        'min_stock',
        'expiration_date',
        'category_id'
    ];

    protected $casts = [
        'expiration_date' => 'date'
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
