<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    protected $fillable = [
        'name','order'
    ];
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'category_types';
    public $timestamps = true;

}