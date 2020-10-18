<?php

namespace App\Http\Controllers\admin;

use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\PricesDelivery\PricesDeliveryCreateRequest;
use App\Http\Requests\admin\PricesDelivery\PricesDeliveryEditRequest;
use App\Models\Company_Delivery;
use App\Models\Log;
use App\Models\PricesDelivery;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PricesDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexpricesdelivery()
    {
        $prices_delivery = PricesDelivery::with('city', 'area', 'company_delivery')->get();
        return view('admin.prices_delivery.prices_delivery_index', compact('prices_delivery'));
    }

    public function createpricesdeliverypost(PricesDeliveryCreateRequest $request)
    {
        $newprices_delivery = new PricesDelivery();
        $newprices_delivery->prices = $request->input('prices');
        $newprices_delivery->city_id = $request->input('city_id');
        $newprices_delivery->area_id = $request->input('area_id');
        $newprices_delivery->company_delivery_id = $request->input('company_delivery_id');
        $newprices_delivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='price company delivery';
        $log->data_change=$newprices_delivery->company_delivery_id ;
        $log->save();
        return redirect('admin/prices_delivery')->with('message', 'Add Prices Delivery Is Done!');
    }

    public function createpricesdeliveryget()
    {
        $city = DB::table("cities")->pluck("name", "id");
        $company_delivery = DB::table("company_deliveries")->pluck("name", "id");
        return view('admin.prices_delivery.prices_delivery_create', compact('city', 'company_delivery'));
    }

    public function editpricesdeliverypost(PricesDeliveryEditRequest $request, $id)
    {
        $newprices_delivery = PricesDelivery::find($id);
        $newprices_delivery->prices = $request->input('prices');
        $newprices_delivery->city_id = $request->input('city_id');
        $newprices_delivery->area_id = $request->input('area_id');
        $newprices_delivery->company_delivery_id = $request->input('company_delivery_id');
        $newprices_delivery->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit company delivery';
        $log->data_change=$newprices_delivery->company_delivery_id ;
        $log->save();
        return redirect('admin/prices_delivery')->with('message', 'Edit Prices Delivery Is Done!');
    }

    public function editpricesdeliveryget($id)
    {
        $prices_delivery = PricesDelivery::find($id);
        $city = DB::table("cities")->pluck("name", "id");
        $company_delivery = DB::table("company_deliveries")->pluck("name", "id");
        return view('admin.prices_delivery.prices_delivery_edit', compact('city', 'company_delivery', 'prices_delivery'));
    }

    public function deletepricesdelivery($id)
    {
        $prices_delivery = PricesDelivery::find($id);
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='delete price company delivery';
        $log->data_change=$prices_delivery->company_delivery_id ;
        $log->save();
        $prices_delivery->delete();
        return redirect()->back()->with('message', 'Delete Prices Delivery Is Done!');
    }

    public function getAreaList(Request $request)
    {
        $area = DB::table("areas")
            ->where("city_id", $request->city_id)
            ->pluck("name", "id");
        return response()->json($area);
    }

    public function searchpricesdeliveryget()
    {
        $city = DB::table("cities")->pluck("name", "id");
        $prices_delivery =null;
        return view('admin.prices_delivery.prices_delivery_search', compact('city','prices_delivery'));
    }

    public function searchpricesdeliverypost(Request $request)
    {
        $prices_delivery = PricesDelivery::with('company_delivery','city','area')->where('city_id', $request->city_id)
            ->where('area_id', $request->area_id)->get();
        return response()->json($prices_delivery);
    }
}

?>