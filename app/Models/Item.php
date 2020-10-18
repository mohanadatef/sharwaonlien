<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'bag_id','brand_id','category_type_id','supplier_id','type_id','size_id','color_id'
        ,'gender_id','code','image_main','weight','cost','order','statues','count_item','user_create_id','statues_item_store'
        ,'height_item','width_item','location_id','price','discount','discount_user_id'
    ];
    public function bag()
    {
        return $this->belongsTo('App\Models\Bag','bag_id');
    }
    public function bag1()
    {
        return $this->belongsTo('App\Models\Bag','bag_id')->where('cost_buy','>',0)->where('cost_profit','>',0);
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
    public function location()
    {
        return $this->belongsTo('App\Models\Location','location_id');
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
    /*public function gender()
    {
        return $this->belongsTo('App\Models\Gender','gender_id');
    }*/
    public function user()
    {
        return $this->belongsTo('App\User','user_create_id');
    }
    public function discount_user()
    {
        return $this->belongsTo('App\User','discount_user_id');
    }
    public function cart_item()
    {
        return $this->belongsTo('App\Models\Cart_Item');
    }
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }
    public function order_item()
    {
        return $this->belongsTo('App\Models\Order_Item');
    }
    protected $table = 'items';
    public $timestamps = true;

}