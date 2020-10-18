<?php

namespace App;
use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name','display_name','description'
    ];
    public function user()
    {
        return $this->belongsToMany('App\User', 'role_user', 'user_id','role_id')->paginate();
    }
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'permission_role')->withTimestamps('created_at','updated_at');
    }
    protected $table = 'roles';
    public $timestamps = true;

}