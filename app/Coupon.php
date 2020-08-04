<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //

    public function users_assigned(){
        // return $this->hasMany('App\CouponsUser','coupon_id','id');
        return $this->hasManyThrough('App\Customer','App\CouponsUser', 'coupon_id','id', 'id','customer_id');
    }
}
