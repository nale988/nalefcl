<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartOrder extends Model
{
    protected $fillable=[
        'date',
        'spare_part_id',
        'position_id',
        'user_id',
        'amount',
        'done',
        'note'
    ];

    public function sparepart(){
        return $this->belongsTo('App\SparePart', 'spare_part_id', 'id');
    }

    public function position(){
        return $this->belongsTo('App\Position', 'position_id', 'id');
    }
}
