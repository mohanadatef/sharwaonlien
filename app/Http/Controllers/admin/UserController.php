<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserEditRequest;
use App\Http\Requests\User\UserResetPasswordCreateRequest;
use App\Models\Account_User;
use App\Models\Customer;
use App\Models\Log;
use App\Role_user;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexuser()
    {
        $users = User::where('kind',1)->get();
        return view('admin.user.user_index', compact('users'));
    }

    public function createuserpost(UserCreateRequest $request)
    {
        $newuser = new User();
        $newuser->username = $request->input('username');
        $newuser->email = $request->input('email');
        $newuser->password = Hash::make($request->input('password'));
        $newuser->statues = 1;
        $newuser->kind = 1;
        $newuser->total_pay = 0;
        $newuser->save();
        $newuser->role()->sync((array)$request->input('role_id'));
        $newuser->save();
        $user = User::where('email',$request->input('email'))->first();
        $newcustomer = new Customer();
        $newcustomer->user_id = $user->id;
        $newcustomer->mobile = '0000000';
        $newcustomer->address = 'company';
        $newcustomer->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create user';
        $log->data_change=$newuser->username;
        $log->save();
        return redirect('/admin/user')->with('message', 'Add user Is Done!');
    }

    public function createuserget()
    {
        $role = Role::select('display_name', 'id')->get();
        return view('admin.user.user_create',compact('role'));
    }

    public function edituserpost(UserEditRequest $request, $id)
    {
        $newuser = User::find($id);
        $newuser->username = $request->input('username');
        $newuser->email = $request->input('email');
        $newuser->role()->sync((array)$request->input('role_id'));
        $newuser->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit user';
        $log->data_change=$newuser->username;
        $log->save();
        return redirect('/admin/user')->with('message', 'Edit User Is Done!');
    }

    public function edituserget($id)
    {
        $user = User::find($id);
        $role = Role::select('display_name', 'id')->get();
        $role_user = Role_user::all()->where('user_id','=',$id);
        return view('admin.user.user_edit', compact('user','role','role_user'));
    }

    public function resetpassworduserpost(UserResetPasswordCreateRequest $request, $id)
    {
        $newuser = User::find($id);
        $newuser->password = Hash::make($request->input('password'));
        $newuser->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='reset password user';
        $log->data_change=$newuser->username;
        $log->save();
        return redirect('admin/user')->with('message', 'reset password user Is Done!');
    }

    public function resetpassworduserget($id)
    {
        $user = User::find($id);
        return view('admin.user.user_reset_password', compact('user'));
    }

    public function editstatues($id)
    {
        $newuser = User::find($id);
        if ($newuser->statues == 1) {
            $newuser->statues = '0';
        } elseif ($newuser->statues == 0) {
            $newuser->statues = '1';
        }
        $newuser->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='change status user';
        $log->data_change=$newuser->username;
        $log->save();
        if($newuser->kind == 1)
        {
        return redirect('/admin/user')->with('message', 'Edit Statues Is Done!');
        }
        else
        {
            return redirect('/admin/customer')->with('message', 'Edit Statues Is Done!');
        }
    }

    public function editallstatues(Request $request)
    {

        $newuser1 = User::wherein('id',  $request->service  )->get();
        foreach($newuser1 as $newuser)
        {
            if ($newuser->statues == 1) {
                $newuser->statues = '0';
            } elseif ($newuser->statues == 0) {
                $newuser->statues = '1';
            }
            $newuser->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='change status user';
            $log->data_change=$newuser->username;
            $log->save();
        }
        return redirect()->back()->with('message', 'Edit Statues Is Done!');
    }

}

?>