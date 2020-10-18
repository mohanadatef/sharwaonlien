<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletUserDelivery extends Model
{
    protected $fillable = [
        'name','position','email','mobile','company_delivery'
    ];
    protected $table = 'templet_user_deliveries';
    public $timestamps = true;

}