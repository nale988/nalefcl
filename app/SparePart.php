<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $fillable=[
        'description',
        'catalogue_number',
        'storage_number',
        'info',
        'spare_part_group',
        'position',
        'unit',
        'danger_level',
        'critical_part',
        'spare_part_type_id',
        'user_id'       
    ];
}
