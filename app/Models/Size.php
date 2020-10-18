<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name','order','code'
    ];
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'sizes';
    public $timestamps = true;

}