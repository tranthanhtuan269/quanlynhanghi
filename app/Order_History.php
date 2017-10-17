<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_History extends Model
{
    protected $table = "order_history";
    protected $fillable = [ 'order_total', 
                            'created_by','created_at'];
                            
    public $timestamps = false;

}
