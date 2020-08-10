<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable=[
        'position_id',
        'total',
        'loaded',
        'starts',
        'comment',
        'date',
        'user_id'
    ];
}
