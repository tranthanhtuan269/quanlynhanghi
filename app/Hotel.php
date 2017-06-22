<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = "hotels";
    protected $fillable = ['name', 'address', 'phone', 'images','district','city','id_tax'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district(){
    	return $this->belongsTo(District::class);
    }
}
