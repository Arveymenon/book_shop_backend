<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    //

    public function customer(){
        return $this->hasOne('App\Customer','player_id','player_id');
    }
}
