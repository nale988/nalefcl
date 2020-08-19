<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlowerServiceFile extends Model
{
    protected $fillable = [
        'file_upload_id',
        'blower_service_id'
    ];
}
