<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable=[
        'user_id',
        'admin',
        'spare_parts_view',
        'spare_parts_add',
        'spare_parts_order',
        'services_view',
        'services_add',
        'workhours_view',
        'workhours_add',
        'workorders_view',
        'workorders_add',
        'lubrications_view',
        'lubrications_add',
        'worktimes',
        'files_view',
        'files_add',
        'todos',
        'favorites'
    ];
}
