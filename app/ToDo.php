<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $fillable=[
        'user_id',
        'date',
        'description',
        'urgent',
        'done'
    ];
}
