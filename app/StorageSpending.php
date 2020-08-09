<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StorageSpending extends Model
{
    //

    protected $fillable=[
        'storage_number',
        'title',
        'price',
        'pieces',
        'unit',
        'workorder_number',
        'worker',
        'date',
        'service',
        'grease'
    ];

}
