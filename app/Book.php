<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'id'
    ];

    public function board(){
        return $this->hasOne('App\Board','id','board_id');
    }

    public function language(){
        return $this->hasOne('App\Language','id','language_id');
    }
}
