<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "districts";
    protected $fillable = [ 'name', 'id_city'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
