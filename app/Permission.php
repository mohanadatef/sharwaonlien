<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission  extends EntrustPermission
{
    protected $fillable = [
        'name','display_name','description'
    ];
    public function role()
    {
        return $this->belongsToMany('App\Role', 'permissions_role', 'role_id','permission_id')->paginate();
    }
    protected $table = 'permissions';
    public $timestamps = true;

}