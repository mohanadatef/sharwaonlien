<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletArea extends Model
{
    protected $fillable = [
        'name','city','order'
    ];
    protected $table = 'templet_areas';
    public $timestamps = true;

}