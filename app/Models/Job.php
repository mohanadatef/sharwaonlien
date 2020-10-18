<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model 
{
    protected $fillable = [
        'tittel','description','order',
    ];
    public function job_request()
    {
        return $this->hasMany('App\Models\JobRequest');
    }
    protected $table = 'jobs';
    public $timestamps = true;

}