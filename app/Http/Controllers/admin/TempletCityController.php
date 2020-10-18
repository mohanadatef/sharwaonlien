<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletCityImport;
use App\Models\City;
use App\Models\Log;
use App\Models\TempletCity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletCityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletcity()
    {
        $templet_city = TempletCity::all();
        return view('admin.import.city.import_city_index', compact('templet_city'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/city');
    }

    public function importcityget()
    {
        return view('admin.import.city.import_city');
    }

    public function importcitypost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletCity::truncate();
        Excel::import(new TempletCityImport(), request()->file('file'));
        $templet_city = TempletCity::find(1);
        $templet_city->delete();
        return redirect('/admin/import/index/city')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedCityGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("cities")->rightjoin('templet_cities', 'cities.name', '=', 'templet_cities.name')
            ->where('cities.name', '!=', null)
            ->select('templet_cities.name')
            ->groupBy('templet_cities.name')
            ->get();
        $cityname = [];

        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($cityname, $matched_result[$i]->name);
        }
        $cityname = array_diff($cityname, ['', 'null']);
        $count_error = count($cityname);
        if ($count_error > 0) {
            return view('admin.import.city.error_city', compact('cityname'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet city';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.city.save_city');
        }
    }

    public function SaveCityGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_city = TempletCity::all();
        foreach ($templet_city as $templet) {
            $newcity = new City();
            $newcity->name = $templet->name;
            $newcity->order = $templet->order;
            $newcity->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create city';
            $log->data_change=$newcity->name;
            $log->save();
        }
        return redirect('admin/city')->with('message', 'Add City Is Done!');
    }
}

?>