<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletType extends Model
{
    protected $fillable = [
        'name','order'
    ];
    protected $table = 'templet_types';
    public $timestamps = true;

}