<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [ 'room_id', 'customer_id', 'created_by', 
                            'created_at','state'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
