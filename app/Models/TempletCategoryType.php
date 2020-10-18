<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletCategoryType extends Model
{
    protected $fillable = [
        'name','order'
    ];
    protected $table = 'templet_category_types';
    public $timestamps = true;

}