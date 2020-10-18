<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{
    protected $fillable = [
        'image','facebook','instgram','logo'
    ];
    protected $table = 'settings';
    public $timestamps = true;

}