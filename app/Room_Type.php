<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rooms";
    protected $fillable = [ 'name', 'priceinroom', 'priceahour', 
                            'priceovernight','priceaday','priceaweek',
                            'priceamonth', 'id_hotel', 'created_by'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
