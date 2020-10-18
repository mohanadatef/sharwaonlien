<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempletSupplier extends Model
{
    protected $fillable = [
        'name','address','mobile','email'
    ];
    protected $table = 'templet_supplieres';
    public $timestamps = true;

}