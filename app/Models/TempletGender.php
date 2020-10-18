<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletGender extends Model
{
    protected $fillable = [
        'name','order'
    ];
    protected $table = 'templet_genderes';
    public $timestamps = true;

}