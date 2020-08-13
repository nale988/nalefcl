<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    protected $fillable=[
        'user_id',
        'position_id'
    ];

}
