<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $fillable=[
        'description',
        'catalogue_number',
        'storage_number',
        'info',
        'order_number',
        'spare_part_group',
        'position',
        'unit',
        'danger_level',
        'critical_part',
        'spare_part_type_id',
        'user_id'
    ];

    public function spareparttype(){
        return $this->belongsTo('App\SparePartType', 'spare_part_type_id', 'id');
    }

    public function files(){
        return $this->belongsToMany('App\FileUpload', 'spare_part_files');
    }

    public function groups(){
        return $this->belongsToMany('App\SparePartGroup', 'spare_part_groups');
    }
}
