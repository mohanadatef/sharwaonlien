<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call_Us extends Model
{
    protected $fillable = [
       'name','message','email'
    ];
    protected $table = 'call_us';
    public $timestamps = true;

}