<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletBrand extends Model
{
    protected $fillable = [
        'name','code','order'
    ];
    protected $table = 'templet_brandes';
    public $timestamps = true;

}