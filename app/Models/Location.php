<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name','count_item','space'
    ];
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'locations';
    public $timestamps = true;

}