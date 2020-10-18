<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    protected $fillable = [
        'name','statues','supplier_id','weight','count_item','cost_buy','cost_profit','user_buy_id','user_create_id','complete'
    ];
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }
    public function user_buy()
    {
        return $this->belongsTo('App\User','user_buy_id');
    }
    public function user_create()
    {
        return $this->belongsTo('App\User','user_create_id');
    }
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    protected $table = 'bags';
    public $timestamps = true;

}