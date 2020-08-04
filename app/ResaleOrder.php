<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResaleOrder extends Model
{
    //
    public function order() {
        return $this->hasOne('App\Order','id','order_id');
    }

    public function details() {
        return $this->hasMany('App\ResaleOrderDetails','resale_order_id','id');
    }

    public function address(){
        return $this->hasOne('App\CustomerAddress','id','address_id');
    }
}
