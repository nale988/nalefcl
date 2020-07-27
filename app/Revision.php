<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $fillable=[
        'date',
        'description',
        'user_id',
        'position_id'
    ];
}
