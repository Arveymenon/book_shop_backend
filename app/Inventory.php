<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //

    protected $table = 'inventory';

    protected $fillable = [
        'retailer_book_id'
    ];

    public function retailers_book(){
        return $this->hasOne('App\RetailersBook','id','retailer_book_id');
    }
}
