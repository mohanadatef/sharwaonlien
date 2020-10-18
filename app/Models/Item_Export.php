<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_Export extends Model
{
    protected $fillable = [
        'bag','brand','category_type','supplier','type','size','color'
        ,'gender','code','weight','cost','statues','statues_item_store','discount'
        ,'minimum_price','last_modified_data','last_modified_time','net','price'
    ];
    protected $table = 'item_exports';
    public $timestamps = true;

}