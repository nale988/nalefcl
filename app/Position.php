<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Position extends Model
{
    protected $fillable=[
        'position',
        'unit_id',
        'name',
        'type',
        'manufacturer',
        'year',
        'capacity',
        'speed',
        'power',
        'archive',
        'capacity1',
        'speed1',
        'power1',
        'photo',
        'schematics',
        'device_type'
    ];

    public function unit(){
        return $this->belongsTo('App\Unit', 'unit_id', 'id');
    }

    public function devicetype(){
        return $this->belongsTo('App\DeviceType', 'device_type_id', 'id');
    }

    public function workorders(){
        return $this->hasMany('App\WorkOrder', 'position', 'positions.position');
    }

    public function spareparts(){
        if (Auth::check()) {
            return $this->belongsToMany('App\SparePart', 'spare_part_connections', 'position_id', 'spare_part_id')->withPivot('amount')->where('spare_parts.user_id', Auth::user()->id);
        }
        else {
            return $this->belongsToMany('App\SparePart', 'spare_part_connections', 'position_id', 'spare_part_id')->withPivot('amount');
        }
    }

    public function files(){
        if (Auth::check()) {
            return $this->belongsToMany('App\FileUpload', 'position_files')->where('file_uploads.user_id', Auth::user()->id);
        }
        else{
            return $this->belongsToMany('App\FileUpload', 'position_files');
        }
    }
}
