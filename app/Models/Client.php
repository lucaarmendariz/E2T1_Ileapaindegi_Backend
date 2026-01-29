<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'surnames',
        'telephone',
        'email',
        'home_client',
        'observations',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
