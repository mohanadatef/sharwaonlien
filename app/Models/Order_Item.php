<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    protected $fillable = [
        'item_id','order_id','status'
    ];
    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id');
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
    public function gender()
    {
        return $this->belongsTo('App\Models\Gender','gender_id');
    }
    protected $table = 'order_items';
    public $timestamps = true;

}