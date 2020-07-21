<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //fans用户
    public function fanuser(){
        return $this->hasOne(\App\User::class,'id','fan_id');
    }

    //被关注用户
    public function staruser(){
        return $this->hasOne(\App\User::class,'id','star_id');
    }
}
