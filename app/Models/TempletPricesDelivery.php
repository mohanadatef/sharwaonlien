<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletPricesDelivery extends Model
{
    protected $fillable = [
        'prices','company_delivery','area','city'
    ];
    protected $table = 'templet_prices_deliveries';
    public $timestamps = true;

}