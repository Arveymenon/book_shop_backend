<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResaleOrderDetails extends Model
{
    //
    protected $table = 'resale_orders_details';

    public function order_detail(){
        return $this->hasOne('App\OrderDetail','id','order_details_id');
    }
}
