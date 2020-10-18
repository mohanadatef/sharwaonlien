<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDelivery extends Model
{
    protected $fillable = [
        'name','position','email','mobile','company_delivery_id'
    ];
    public function company_delivery()
    {
        return $this->belongsTo('App\Models\Company_Delivery','company_delivery_id');
    }
    protected $table = 'user_deliveries';
    public $timestamps = true;

}