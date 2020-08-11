<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CompressorService extends Model
{
    protected $fillable=[
        'position_id',
        'user_id',
        'date',
        'total',
        'type',
        'comment'
    ];

    public function files(){
        if (Auth::check()) {
            return $this->belongsToMany('App\FileUpload', 'compressor_service_files')->where('file_uploads.user_id', Auth::user()->id);
        }
        else{
            return $this->belongsToMany('App\FileUpload', 'compressor_service_files');
        }
    }
}
