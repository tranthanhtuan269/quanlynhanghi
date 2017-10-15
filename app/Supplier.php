<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "suppliers";
    protected $fillable = [ 'name', 'price', 'number', 
                            'id_supplier'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
