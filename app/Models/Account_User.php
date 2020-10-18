<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account_User extends Model
{
    protected $fillable = [
        'take','pay','total_before','total_after','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    protected $table = 'account_users';
    public $timestamps = true;

}