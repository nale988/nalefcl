<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SparePartType extends Model
{
    protected $fillable=['description'];

    public function spareparts(){
        if (Auth::check()) {
            return $this->hasMany('App\SparePart', 'spare_part_type_id', 'id')->where('spare_parts.user_id', Auth::user()->id);
        }
        else{
            return $this->hasMany('App\SparePart', 'spare_part_type_id', 'id');
        }
    }

}
