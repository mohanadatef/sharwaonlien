<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model 
{
    protected $fillable = [
        'address','latitude','longitude','phone','email'
    ];
    protected $table = 'contact_us';
    public $timestamps = true;

}