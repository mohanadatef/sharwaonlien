<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model 
{
    protected $fillable = [
        'description','image'
    ];
    protected $table = 'about_us';
    public $timestamps = true;

}