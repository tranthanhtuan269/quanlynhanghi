<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [ 'room_id', 'customer_id', 'created_by', 
                            'created_at', 'state', 'price_order', 'updated_at'];

    public $timestamps = false;
}
