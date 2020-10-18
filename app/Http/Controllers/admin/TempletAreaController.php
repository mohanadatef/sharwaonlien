<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletAreaImport;
use App\Models\Area;
use App\Models\City;
use App\Models\Log;
use App\Models\TempletArea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletarea()
    {
        $templet_area = TempletArea::all();
        return view('admin.import.area.import_area_index', compact('templet_area'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/area');
    }

    public function importareaget()
    {
        return view('admin.import.area.import_area');
    }

    public function importareapost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletArea::truncate();
        Excel::import(new TempletAreaImport(), request()->file('file'));
        $templet_area = TempletArea::find(1);
        $templet_area->delete();
        return redirect('/admin/import/index/area')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedAreaGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("areas")->rightjoin('templet_areas', 'areas.name', '=', 'templet_areas.name')
            ->where('areas.name', '!=', null)
            ->select('templet_areas.name')
            ->groupBy('templet_areas.name')
            ->get();
        $areaname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($areaname, $matched_result[$i]->name);
        }
        $areaname = array_diff($areaname, ['', 'null']);
        $matched_result = DB::table("cities")->rightjoin('templet_areas', 'cities.name', '=', 'templet_areas.city')
            ->where('cities.name', '=', null)
            ->select('templet_areas.city')
            ->groupBy('templet_areas.city')
            ->get();
        $cityname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($cityname, $matched_result[$i]->city);
        }
        $cityname = array_diff($cityname, ['', 'null']);
        $count_error = count($areaname+$cityname);
        if ($count_error > 0) {
            return view('admin.import.area.error_area', compact('areaname','cityname'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet area';
            $log->data_change='      ' ;
            $log->save();
            return view('admin.import.area.save_area');
        }
    }

    public function SaveAreaGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_area = TempletArea::all();
        foreach ($templet_area as $templet) {
            $newarea = new Area();
            $newarea->name = $templet->name;
            $newarea->order = $templet->order;
            $city = City::where('name', $templet->city)->first();
            $newarea->city_id = $city->id;
            $newarea->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create area';
            $log->data_change=$newarea->name ;
            $log->save();
        }
        return redirect('admin/area')->with('message', 'Add Area Is Done!');
    }
}

?>