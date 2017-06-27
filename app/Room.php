<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rooms";
    protected $fillable = [ 'name', 'images', 'room_type', 'order_type', 'state', 'created_by'];
    public $timestamps = false;

    public function changeStatusRoom($id, $status, $user_id, $token_id, $ip_address){
        // if()
    }
}
