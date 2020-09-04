<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schematic extends Model
{
    protected $fillable=[
        'unit_id',
        'path',
        'description'
    ];
}
