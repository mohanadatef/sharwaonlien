<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletCompanyDeliveryImport;
use App\Models\Company_Delivery;
use App\Models\Log;
use App\Models\TempletCompanyDelivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletCompanyDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletcompanydelivery()
    {
        $templet_company_delivery = TempletCompanyDelivery::all();
        return view('admin.import.company_delivery.import_company_delivery_index', compact('templet_company_delivery'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/company_delivery');
    }

    public function importcompanydeliveryget()
    {
        return view('admin.import.company_delivery.import_company_delivery');
    }

    public function importcompanydeliverypost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletCompanyDelivery::truncate();
        Excel::import(new TempletCompanyDeliveryImport(), request()->file('file'));
        $templet_company_delivery = TempletCompanyDelivery::find(1);
        $templet_company_delivery->delete();
        return redirect('/admin/import/index/company_delivery')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedCompanyDeliveryGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("company_deliveries")->rightjoin('templet_company_deliveries', 'company_deliveries.name', '=', 'templet_company_deliveries.name')
            ->where('company_deliveries.name', '!=', null)
            ->select('templet_company_deliveries.name')
            ->groupBy('templet_company_deliveries.name')
            ->get();
        $company_deliveryname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($company_deliveryname, $matched_result[$i]->name);
        }
        $company_deliveryname = array_diff($company_deliveryname, ['', 'null']);
        $count_error = count($company_deliveryname );
        if ($count_error > 0) {
            return view('admin.import.company_delivery.error_company_delivery', compact('company_deliveryname'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet company delivery';
                $log->data_change=' ';
            $log->save();
            return view('admin.import.company_delivery.save_company_delivery');
        }
    }

    public function SaveCompanyDeliveryGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_company_delivery = TempletCompanyDelivery::all();
        foreach ($templet_company_delivery as $templet) {
            $newcompanydelivery = new Company_Delivery();
            $newcompanydelivery->name = $templet->name;
            $newcompanydelivery->mobile = $templet->mobile;
            $newcompanydelivery->address = $templet->address;
            $newcompanydelivery->email = $templet->email;
            $newcompanydelivery->performance = $templet->performance;
            $newcompanydelivery->description = $templet->description;
            $newcompanydelivery->count_order_book = 0;
            $newcompanydelivery->count_order_have = 0;
            $newcompanydelivery->total_pay = 0;
            $newcompanydelivery->statues = 1;
            $newcompanydelivery->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create company delivery';
            $log->data_change=$newcompanydelivery->name;
            $log->save();
        }
        return redirect('admin/company_delivery')->with('message', 'Add Category Type Is Done!');
    }
}

?>