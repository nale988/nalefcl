<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevisionFile extends Model
{
    protected $fillable = [
        'file_upload_id',
        'revision_id'
    ];
}
