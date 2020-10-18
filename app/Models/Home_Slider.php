<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home_Slider extends Model
{
    protected $fillable = [
        'image','order'
    ];
    protected $table = 'home_slideres';
    public $timestamps = true;

}