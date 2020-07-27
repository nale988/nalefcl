<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $fillable=[
        'user_id',
        'filename',
        'filesize',
        'url'
    ];
}
