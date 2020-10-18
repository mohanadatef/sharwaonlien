<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account_Company extends Model
{
    protected $fillable = [
        'take','pay','total_before','total_after','company_id'
    ];
    public function company()
    {
        return $this->belongsTo('App\Model\Company_Delivery','company_id');
    }
    protected $table = 'account_copmanies';
    public $timestamps = true;

}