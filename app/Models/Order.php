<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name','address','user_create_order_id','notes','delivery','company_delivery_id','user_take_id','client','total_cost'
        ,'statues','cost_after_discount','count_item_order','mobile','prices_delivery','time_discarded','discarded','discarded_cost'
        ,'time_cancellation','cancellation','cancellation_cost'
    ];
    public function user()
    {
        return $this->belongsToMany('App\Models', 'order_item', 'item_id','order_id')->paginate();
    }
    public function user_take()
    {
        return $this->belongsTo('App\User','user_take_id');
    }
    public function company_delivery()
    {
        return $this->belongsTo('App\Models\Company_Delivery','company_delivery_id');
    }
    public function user_create_order()
    {
        return $this->belongsTo('App\User','user_create_order_id');
    }
    public function order_item()
    {
        return $this->hasMany('App\Models\Order_Item');
    }
    protected $table = 'orders';
    public $timestamps = true;

}