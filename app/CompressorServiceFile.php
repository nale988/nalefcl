<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompressorServiceFile extends Model
{
    protected $fillable = [
        'file_upload_id',
        'compressor_service_id'
    ];
}
