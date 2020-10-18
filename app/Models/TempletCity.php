<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletCity extends Model
{
    protected $fillable = [
        'name','order'
    ];

    protected $table = 'templet_cities';
    public $timestamps = true;

}