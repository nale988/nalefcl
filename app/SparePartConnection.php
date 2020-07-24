<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartConnection extends Model
{
    protected $fillable=[
        'position_id',
        'spare_part_id',
        'amount'
    ];
}
