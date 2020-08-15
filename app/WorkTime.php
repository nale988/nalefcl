<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkTime extends Model
{
    protected $fillable=[
        'date',
        'user_id',
        'starttime',
        'endtime',
        'workorder',
        'description',
        'regulartime',
        'overtime',
        'vacation',
        'worktime_hours',
        'overtime_hours',
        'freetime_hours'
    ];
}
