<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name','order'
    ];
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'colores';
    public $timestamps = true;

}