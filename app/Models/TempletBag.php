<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletBag extends Model
{
    protected $fillable = [
        'name','supplier','weight','cost_buy','cost_profit','user_buy'
    ];
    protected $table = 'templet_bags';
    public $timestamps = true;

}