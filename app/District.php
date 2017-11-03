<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "districts";
    protected $fillable = [ 'name', 'city', 'active'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
