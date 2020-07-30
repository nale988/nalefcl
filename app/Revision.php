<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Revision extends Model
{
    protected $fillable=[
        'description',
        'user_id',
        'position_id'
    ];

    public function files(){
        if (Auth::check()) {
            return $this->belongsToMany('App\FileUpload', 'revision_files')->where('file_uploads.user_id', Auth::user()->id);
        }
        else{
            return $this->belongsToMany('App\FileUpload', 'revision_files');
        }
    }

    public function position(){
        return $this->belongsTo('App\Position');
    }
}
