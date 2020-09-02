<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $fillable=[
        'user_id',
        'spare_parts_view',
        'use_todos',
        'use_favorites',
        'show_home_pareto',
        'theme'
    ];
}
