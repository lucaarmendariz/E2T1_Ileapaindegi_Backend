<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day',
        'group_id',
        'start_time',
        'end_time'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
