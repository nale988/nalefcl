<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlowerService extends Model
{
    protected $fillable=[
        'position_id',
        'user_id',
        'date',
        'inspection',
        'filter',
        'belt',
        'pulley',
        'oil',
        'nonreturn_valve',
        'element_repair',
        'element_replace',
        'first_start',
        'other',
        'comment'
    ];
}
