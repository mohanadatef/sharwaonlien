<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    protected $fillable = [
        'username','email','password','statues','total_pay','kind'
    ];
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps('created_at','updated_at');
    }
    public function role_iformation()
    {
        return $this->belongsToMany('App\Role_user');
    }
    public function bag()
    {
        return $this->hasMany('App\Models\Bag');
    }
    public function log()
    {
        return $this->hasMany('App\Models\Log');
    }
    public function account()
    {
        return $this->hasMany('App\Models\Account_User');
    }
    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    public function cart_item()
    {
        return $this->hasMany('App\Models\Cart_Item');
    }
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    protected $table = 'users';
    public $timestamps = true;

}