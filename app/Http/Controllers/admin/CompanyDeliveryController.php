<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CompanyDelivery\CompanyDeliveryCreateRequest;
use App\Http\Requests\admin\CompanyDelivery\CompanyDeliveryEditRequest;
use App\Models\Company_Delivery;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class CompanyDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexcompanydelivery()
    {
        $company_delivery = Company_Delivery::orderBy('statues', 'desc')->get();
        return view('admin.company_delivery.company_delivery_index', compact('company_delivery'));
    }

    public function createcompanydeliverypost(CompanyDeliveryCreateRequest $request)
    {
        $newcompany_delivery = new Company_Delivery();
        $newcompany_delivery->name = $request->input('name');
        $newcompany_delivery->mobile = $request->input('mobile');
        $newcompany_delivery->address = $request->input('address');
        $newcompany_delivery->email = ' ';
        $newcompany_delivery->performance = $request->input('performance');
        $newcompany_delivery->description = ' ';
        $newcompany_delivery->count_order_book = 0;
        $newcompany_delivery->count_order_have = 0;
        $newcompany_delivery->total_pay = 0;
        $newcompany_delivery->statues = 1;
        $newcompany_delivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create company delivery';
        $log->data_change=$newcompany_delivery->name ;
        $log->save();
        return redirect('/admin/company_delivery')->with('message', 'Add Company Delivery Is Done!');
    }

    public function createcompanydeliveryget()
    {
        return view('admin.company_delivery.company_delivery_create');
    }

    public function editcompanydeliverypost(CompanyDeliveryEditRequest $request, $id)
    {
        $newcompany_delivery = Company_Delivery::find($id);
        $newcompany_delivery->name = $request->input('name');
        $newcompany_delivery->mobile = $request->input('mobile');
        $newcompany_delivery->address = $request->input('address');
        $newcompany_delivery->performance = $request->input('performance');
        if ($request->input('email') == null) {
            $newcompany_delivery->email = ' ';
        } else {
            $newcompany_delivery->email = $request->input('email');
        }
        if ($request->input('description') == null) {
            $newcompany_delivery->description = ' ';
        } else {
            $newcompany_delivery->description = $request->input('description');
        }
        $newcompany_delivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='ُEdit company delivery';
        $log->data_change=$newcompany_delivery->name ;
        $log->save();
        return redirect('/admin/company_delivery')->with('message', 'Edit Company Delivery Is Done!');
    }

    public function editcompanydeliveryget($id)
    {
        $company_delivery = Company_Delivery::find($id);
        return view('admin.company_delivery.company_delivery_edit', compact('company_delivery'));
    }



    public function showcompanydelivery($id)
    {
        $company_delivery = Company_Delivery::find($id);
        return view('admin.company_delivery.company_delivery_show', compact('company_delivery'));
    }

    public function editstatues($id)
    {
        $company_delivery = Company_Delivery::find($id);
        if ($company_delivery->statues == 1) {
            $company_delivery->statues = '0';
        } elseif ($company_delivery->statues == 0) {
            $company_delivery->statues = '1';
        }
        $company_delivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit status company delivery';
        $log->data_change=$company_delivery->name ;
        $log->save();
        return redirect('/admin/company_delivery')->with('message', 'Edit Statues Is Done!');
    }
}

?>