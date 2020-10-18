<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletCompanyDelivery extends Model
{
    protected $fillable = [
        'name','mobile','email','address','performance','description','count_order_book','count_order_have','statues','total_pay'
    ];
    protected $table = 'templet_company_deliveries';
    public $timestamps = true;

}