<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompressorService extends Model
{
    protected $fillable=[
        'position_id',
        'user_id',
        'date',
        'total',
        'type',
        'comment'
    ];
}
