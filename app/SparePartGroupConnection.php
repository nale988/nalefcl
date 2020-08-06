<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartGroupConnection extends Model
{
    protected $fillable=[
        'spare_part_id',
        'spare_part_group_id'
    ];
}
