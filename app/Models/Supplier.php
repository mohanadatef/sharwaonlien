<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','address','mobile','email','statues'
    ];
    public function bag()
    {
        return $this->hasMany('App\Models\Bag');
    }
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'supplieres';
    public $timestamps = true;

}