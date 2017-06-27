<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table = "order_detail";
    protected $fillable = [ 'service_id', 'order_id', 'number_count', 
                            'created_by','created_at'];
                            
    public $timestamps = false;

}
