<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleEditRequest;
use App\Models\Log;
use App\Permission;
use App\Permission_role;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexrole()
    {
            if(Auth::user()->role()->first()->id == 1)
            {
                $role = Role::all();
            }
            else
            {
            $role = Role::where('id','!=',1)->where('id','!=',6)->where('id','!=',3)->get();
            }
        return view('admin.role.role_index', compact('role'));
    }

    public function createrolepost(RoleCreateRequest $request)
    {
        $newrole = new Role();
        $newrole->name = $request->input('name');
        $newrole->display_name = $request->input('display_name');
        $newrole->description = $request->input('description');
        $newrole->save();
        $newrole->permission()->sync((array)$request->input('permission'));
        $newrole->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create role';
        $log->data_change=$newrole->name ;
        $log->save();
        return redirect('/admin/role')->with('message', 'Add Roles Is Done!');
    }

    public function createroleget()
    {
        $permission = Permission::select('display_name', 'id')->get();
        return view('admin.role.role_create', compact('permission'));
    }

    public function editrolepost(RoleEditRequest $request, $id)
    {
        $newrole = Role::find($id);
        $newrole->name = $request->input('name');
        $newrole->display_name = $request->input('display_name');
        $newrole->description = $request->input('description');
        $newrole->permission()->sync((array)$request->input('permission'));
        $newrole->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit role';
        $log->data_change=$newrole->name ;
        $log->save();
        return redirect('/admin/role')->with('message', 'Edit Roles Is Done!');
    }

    public function editroleget($id)
    {
        $role = Role::find($id);
        $permission = Permission::select('display_name', 'id')->get();
        $permission_role = Permission_role::all()->where('role_id','=',$id);
        return view('admin.role.role_edit', compact('role', 'permission','permission_role'));
    }


}

?>