<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionFile extends Model
{
    protected $fillable=[
        'file_upload_id',
        'position_id',
        'private_item'
    ];

    public function position(){
        return $this->belongsTo('App\Position', 'position_id', 'id');
    }

    public function file(){
        return $this->belongsTo('App\FileUpload', 'file_upload_id', 'id');
    }
}
