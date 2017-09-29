<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Order extends Model
{
    protected $table = "service_order";
    protected $fillable = ['service_id', 'service_number', 'created_date'];
                            
    public $timestamps = false;

}
