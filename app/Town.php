<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = "towns";
    protected $fillable = [ 'name', 'district', 'active'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
