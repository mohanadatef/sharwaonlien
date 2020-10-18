<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletItem extends Model
{
    protected $fillable = [
        'bag','brand','category_type','type','size','color'/*,'gender'*/,'discount',
        'image_main','weight','cost'/*,'order'*/,'height_item','width_item','price','location'
    ];
    protected $table = 'templet_items';
    public $timestamps = true;

}