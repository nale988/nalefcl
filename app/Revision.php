<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Revision extends Model
{
    protected $fillable=[
        'description',
        'user_id',
        'position_id',
        'private_item'
    ];

    public function files(){
        return $this->belongsToMany('App\FileUpload', 'revision_files');
    }

    public function position(){
        return $this->belongsTo('App\Position');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
