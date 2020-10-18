<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company_Delivery extends Model
{
    protected $fillable = [
        'name','mobile','email','address','performance','description','count_order_book','count_order_have','statues','total_pay'
    ];
    public function user_delivery()
    {
        return $this->hasMany('App\Models\UserDelivery');
    }
    public function prices_delivery()
    {
        return $this->hasMany('App\Models\PricesDelivery');
    }
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function account()
    {
        return $this->hasMany('App\Models\Account_Company');
    }
    protected $table = 'company_deliveries';
    public $timestamps = true;

}