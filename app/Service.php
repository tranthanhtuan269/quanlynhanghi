<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";
    protected $fillable = [ 'name', 'price', 'number', 
                            'id_supplier','id_hotel'];

    public $timestamps = false;
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
