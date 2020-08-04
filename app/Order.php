<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    public function details(){
        return $this->hasMany('App\OrderDetail','order_id','id');
    }
    public function resale_order(){
        return $this->hasMany('App\ResaleOrder','order_id','id');
    }

    public function customer(){
        return $this->hasOne('App\Customer','id','customer_id');
    }

    public function address(){
        return $this->hasOne('App\CustomerAddress','id','address_id');
    }

    public function particular(){
        return $this->hasMany('App\Particular','order_id','id');
    }
}
