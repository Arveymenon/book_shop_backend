<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //

    public function book(){
        return $this->hasOne('App\Book','id','product_id');
    }

    public function package(){
        return $this->hasOne('App\Package','id','product_id');
    }
}
