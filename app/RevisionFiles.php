<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevisionFiles extends Model
{
    protected $fillable = [
        'file_upload_id',
        'revision_id'
    ];
}
