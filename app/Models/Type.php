<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name','order'
    ];
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'types';
    public $timestamps = true;

}