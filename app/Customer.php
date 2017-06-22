<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";
    protected $fillable = [ 'firstname', 'lastname', 'birthday', 
                            'birthmonth','birthyear', 'phone', 
                            'email', 'address', 'district', 'city'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
