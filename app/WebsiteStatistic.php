<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteStatistic extends Model
{
    protected $fillable=[
        'ip',
        'ip_proxy',
        'useragent',
        'page',
        'city',
        'region',
        'country',
        'loc',
        'org',
        'user_id'
    ];
}
