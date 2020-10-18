<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricesDelivery extends Model
{
    protected $fillable = [
        'prices','company_delivery_id','area_id','city_id'
    ];
    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
    public function area()
    {
        return $this->belongsTo('App\Models\Area','area_id');
    }
    public function company_delivery()
    {
        return $this->belongsTo('App\Models\Company_Delivery','company_delivery_id');
    }
    protected $table = 'prices_deliveries';
    public $timestamps = true;

}