<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id','mobile','address'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    protected $table = 'customers';
    public $timestamps = true;

}