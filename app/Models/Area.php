<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name','city_id','order'
    ];
    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
    public function prices_delivery()
    {
        return $this->hasMany('App\Models\PricesDelivery');
    }
    protected $table = 'areas';
    public $timestamps = true;

}