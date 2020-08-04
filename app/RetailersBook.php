<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailersBook extends Model
{
    //
    protected $fillable = [
        'user_id'
    ];

    public function book(){
        return $this->hasOne('App\Book','id','book_id');
    }
}
