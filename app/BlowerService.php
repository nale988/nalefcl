<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BlowerService extends Model
{
    protected $fillable=[
        'position_id',
        'user_id',
        'date',
        'inspection',
        'filter',
        'belt',
        'pulley',
        'oil',
        'nonreturn_valve',
        'element_repair',
        'element_replace',
        'first_start',
        'other',
        'comment'
    ];

    public function files(){
        if (Auth::check()) {
            return $this->belongsToMany('App\FileUpload', 'blower_service_files')->where('file_uploads.user_id', Auth::user()->id);
        }
        else{
            return $this->belongsToMany('App\FileUpload', 'blower_service_files');
        }
    }
}
