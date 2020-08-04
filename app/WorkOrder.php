<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    protected $fillable=[
        'number',
        'unit',
        'position',
        'content',
        'date',
        'date1',
        'comment',
        'preventive_maintenance',
        'intervention',
        'fix',
        'general_repair',
        'contracotr',
        'worker1',
        'worker2',
        'worker3',
        'worker4',
        'owner',
        'attachment',
        'attachment1',
        'finished',
        'planned'
    ];

}
