<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletColor extends Model
{
    protected $fillable = [
        'name','order'
    ];
    protected $table = 'templet_colores';
    public $timestamps = true;

}