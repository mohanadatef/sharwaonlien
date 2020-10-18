<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Item extends Model
{
    protected $fillable = [
        'item_id','user_select_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_select_id');
    }
    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id');
    }
    public function bag()
    {
        return $this->belongsTo('App\Models\Bag','bag_id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    public function category_type()
    {
        return $this->belongsTo('App\Models\CategoryType','category_type_id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\Type','type_id');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }
    public function size()
    {
        return $this->belongsTo('App\Models\Size','size_id');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color','color_id');
    }
 /*   public function gender()
    {
        return $this->belongsTo('App\Models\Gender','gender_id');
    }*/
    protected $table = 'cart_items';
    public $timestamps = true;
}