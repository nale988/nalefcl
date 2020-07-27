<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SparePartType extends Model
{
    protected $fillable=['description'];

    public function spareparts(){
        return $this->hasMany('App\SparePart', 'spare_part_type_id', 'id');
    }
}
