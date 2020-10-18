<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{
    protected $fillable = [
        'name','order'
    ];
    public function area()
    {
        return $this->hasMany('App\Models\Area');
    }
    public function prices_delivery()
    {
        return $this->hasMany('App\Models\PricesDelivery');
    }
    protected $table = 'cities';
    public $timestamps = true;

}