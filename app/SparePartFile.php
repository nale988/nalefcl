<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartFile extends Model
{
    protected $fillable=[
        'file_upload_id',
        'spare_part_id'
    ];

    public function sparepart(){
        return $this->belongsTo('App\SparePart', 'spare_part_id', 'id');
    }
}
