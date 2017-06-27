<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_Type extends Model
{
    protected $table = "room_type";
    protected $fillable = [ 
							'name', 
							'priceinroom', 
							'priceahour', 
                            'priceovernight',
                            'priceaday',
                            'priceaweek',
                            'priceamonth', 
                            'id_hotel', 
                            'created_by'
                            ];

    public $timestamps = false;
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
