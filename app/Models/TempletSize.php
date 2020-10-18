<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletSize extends Model
{
    protected $fillable = [
        'name','order','code'
    ];
    protected $table = 'templet_sizes';
    public $timestamps = true;

}