<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletPricesDeliveryImport;
use App\Models\Area;
use App\Models\Company_Delivery;
use App\Models\Log;
use App\Models\PricesDelivery;
use App\Models\City;
use App\Models\TempletPricesDelivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletPricesDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletpricesdelivery()
    {
        $templet_prices_delivery = TempletPricesDelivery::all();
        return view('admin.import.prices_delivery.import_prices_delivery_index', compact('templet_prices_delivery'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/prices_delivery');
    }

    public function importpricesdeliveryget()
    {
        return view('admin.import.prices_delivery.import_prices_delivery');
    }

    public function importpricesdeliverypost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletPricesDelivery::truncate();
        Excel::import(new TempletPricesDeliveryImport(), request()->file('file'));
        $templet_prices_delivery = TempletPricesDelivery::find(1);
        $templet_prices_delivery->delete();
        return redirect('/admin/import/index/prices_delivery')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedPricesDeliveryGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("company_deliveries")->rightjoin('templet_prices_deliveries', 'company_deliveries.name', '=', 'templet_prices_deliveries.company_delivery')
            ->where('company_deliveries.name', '=', null)
            ->select('templet_prices_deliveries.company_delivery')
            ->groupBy('templet_prices_deliveries.company_delivery')
            ->get();
        $company_deliveryname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($company_deliveryname, $matched_result[$i]->company_delivery);
        }
        $company_deliveryname = array_diff($company_deliveryname, ['', 'null']);
        $matched_result = DB::table("cities")->rightjoin('templet_prices_deliveries', 'cities.name', '=', 'templet_prices_deliveries.city')
            ->where('cities.name', '=', null)
            ->select('templet_prices_deliveries.city')
            ->groupBy('templet_prices_deliveries.city')
            ->get();
        $cityname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($cityname, $matched_result[$i]->city);
        }
        $cityname = array_diff($cityname, ['', 'null']);
        $matched_result = DB::table("areas")->rightjoin('templet_prices_deliveries', 'areas.name', '=', 'templet_prices_deliveries.area')
            ->where('areas.name', '=', null)
            ->select('templet_prices_deliveries.area')
            ->groupBy('templet_prices_deliveries.area')
            ->get();
        $areaname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($areaname, $matched_result[$i]->area);
        }
        $areaname = array_diff($areaname, ['', 'null']);
        $count_error = count($company_deliveryname+$cityname+$areaname);
        if ($count_error > 0) {
            return view('admin.import.prices_delivery.error_prices_delivery', compact('company_deliveryname','cityname','areaname'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet price company delivery';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.prices_delivery.save_prices_delivery');
        }
    }

    public function SavePricesDeliveryGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_prices_delivery = TempletPricesDelivery::all();
        foreach ($templet_prices_delivery as $templet) {
            $newprices_delivery = new PricesDelivery();
            $area = Area::where('name', $templet->area)->first();
            $newprices_delivery->area_id = $area->id;
            $company_delivery = Company_Delivery::where('name', $templet->company_delivery)->first();
            $newprices_delivery->company_delivery_id = $company_delivery->id;
            $city = City::where('name', $templet->city)->first();
            $newprices_delivery->city_id = $city->id;
            $newprices_delivery->prices = $templet->prices;
            $newprices_delivery->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='price company delivery';
            $log->data_change=$newprices_delivery->area_id;
            $log->save();
        }
        return redirect('admin/prices_delivery')->with('message', 'Add Prices Delivery Is Done!');
    }
}

?>