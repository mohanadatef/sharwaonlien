<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserDelivery\UserDeliveryCreateRequest;
use App\Http\Requests\admin\UserDelivery\UserDeliveryEditRequest;
use App\Models\Log;
use App\Models\UserDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexuserdelivery()
    {
        $user_delivery = UserDelivery::with('company_delivery')->get();
        return view('admin.user_delivery.user_delivery_index', compact('user_delivery'));
    }

    public function createuserdeliverypost(UserDeliveryCreateRequest $request)
    {
        $newuserdelivery = new UserDelivery();
        $newuserdelivery->name = $request->input('name');
        $newuserdelivery->mobile = $request->input('mobile');
        if($request->input('email')==null)
        {
            $newuserdelivery->email=' ';
        }
        else{
            $newuserdelivery->email = $request->input('email');
        }
        $newuserdelivery->code = $request->input('code');
        $newuserdelivery->company_delivery_id = $request->input('company_delivery_id');
        $newuserdelivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create user delivery';
        $log->data_change=$newuserdelivery->name;
        $log->save();
        return redirect('admin/user_delivery')->with('message', 'Add User Delivery Is Done!');
    }

    public function createuserdeliveryget()
    {
        $company_delivery = DB::table("company_deliveries")->pluck("name", "id");
        return view('admin.user_delivery.user_delivery_create', compact('company_delivery'));
    }

    public function edituserdeliverypost(UserDeliveryEditRequest $request, $id)
    {

        $newuserdelivery = UserDelivery::find($id);
        $newuserdelivery->name = $request->input('name');
        $newuserdelivery->mobile = $request->input('mobile');
        if($request->input('email')==null)
        {
            $newuserdelivery->email=' ';
        }
        else{
        $newuserdelivery->email = $request->input('email');
        }
        $newuserdelivery->code = $request->input('code');
        $newuserdelivery->company_delivery_id = $request->input('company_delivery_id');
        $newuserdelivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit user delivery';
        $log->data_change=$newuserdelivery->name;
        $log->save();
        return redirect('admin/user_delivery')->with('message', 'Edit User Delivery Is Done!');
    }

    public function edituserdeliveryget($id)
    {
        $user_delivery = UserDelivery::find($id);
        $company_delivery = DB::table("company_deliveries")->pluck("name", "id");
        return view('admin.user_delivery.user_delivery_edit', compact('company_delivery', 'user_delivery'));
    }

    public function deleteuserdelivery($id)
    {
        $userdelivery = UserDelivery::find($id);
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='delete user delivery';
        $log->data_change=$userdelivery->name;
        $log->save();
        $userdelivery->delete();
        return redirect()->back()->with('message', 'Delete User Delivery Is Done!');
    }
}

?>