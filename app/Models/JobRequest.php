<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    protected $fillable = [
        'first_name','last_name','email','mobile','gender','birth_date',
        'university','faculty','year','grade','message','resume','job_id'
    ];
    public function job()
    {
        return $this->belongsTo('App\Models\Job','job_id');
    }
    protected $table = 'job_requests';
    public $timestamps = true;

}