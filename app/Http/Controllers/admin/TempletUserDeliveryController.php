<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletUserDeliveryImport;
use App\Models\Company_Delivery;
use App\Models\Log;
use App\Models\UserDelivery;
use App\Models\TempletUserDelivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletUserDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletuserdelivery()
    {
        $templet_user_delivery = TempletUserDelivery::all();
        return view('admin.import.user_delivery.import_user_delivery_index', compact('templet_user_delivery'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/user_delivery');
    }

    public function importuserdeliveryget()
    {
        return view('admin.import.user_delivery.import_user_delivery');
    }

    public function importuserdeliverypost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletUserDelivery::truncate();
        Excel::import(new TempletUserDeliveryImport(), request()->file('file'));
        $templet_user_delivery = TempletUserDelivery::find(1);
        $templet_user_delivery->delete();
        return redirect('/admin/import/index/user_delivery')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedUserDeliveryGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("company_deliveries")->rightjoin('templet_user_deliveries', 'company_deliveries.name', '=', 'templet_user_deliveries.company_delivery')
            ->where('company_deliveries.name', '=', null)
            ->select('templet_user_deliveries.company_delivery')
            ->groupBy('templet_user_deliveries.company_delivery')
            ->get();
        $company_deliveryname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($user_deliveryname, $matched_result[$i]->company_delivery);
        }
        $company_deliveryname = array_diff($company_deliveryname, ['', 'null']);
        $matched_result = DB::table("user_deliveries")->rightjoin('templet_user_deliveries', 'user_deliveries.name', '=', 'templet_user_deliveries.name')
            ->where('user_deliveries.name', '!=', null)
            ->select('templet_user_deliveries.name')
            ->groupBy('templet_user_deliveries.name')
            ->get();
        $user_deliveryname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($user_deliveryname, $matched_result[$i]->name);
        }
        $user_deliveryname = array_diff($user_deliveryname, ['', 'null']);
        $count_error = count($user_deliveryname+$company_deliveryname );
        if ($count_error > 0) {
            return view('admin.import.user_delivery.error_user_delivery', compact('user_deliveryname','company_deliveryname'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='importsheet user delivery';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.user_delivery.save_user_delivery');
        }
    }

    public function SaveUserDeliveryGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_user_delivery = TempletUserDelivery::all();
        foreach ($templet_user_delivery as $templet) {
            $newuserdelivery = new UserDelivery();
            $newuserdelivery->name = $templet->name;
            $newuserdelivery->mobile = $templet->mobile;
            $newuserdelivery->position = $templet->position;
            if($templet->email != null)
            {
                $newuserdelivery->email = $templet->email;
            }
            else
            {
                $newuserdelivery->email ="  ";
            }
            $company_delivery = Company_Delivery::where('name', $templet->company_delivery)->first();
            $newuserdelivery->company_delivery_id = $company_delivery->id;
            $newuserdelivery->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create user delivery';
            $log->data_change=$newuserdelivery->name;
            $log->save();
        }
        return redirect('admin/user_delivery')->with('message', 'Add Category Type Is Done!');
    }
}

?>