<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletBrandImport;
use App\Models\Brand;
use App\Models\Log;
use App\Models\TempletBrand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletbrand()
    {
        $templet_brand = TempletBrand::all();
        return view('admin.import.brand.import_brand_index', compact('templet_brand'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/brand');
    }

    public function importbrandget()
    {
        return view('admin.import.brand.import_brand');
    }

    public function importbrandpost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletBrand::truncate();
        Excel::import(new TempletBrandImport(), request()->file('file'));
        $templet_brand = TempletBrand::find(1);
        $templet_brand->delete();
        return redirect('/admin/import/index/brand')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedBrandGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("brandes")->rightjoin('templet_brandes', 'brandes.name', '=', 'templet_brandes.name')
            ->where('brandes.name', '!=', null)
            ->select('templet_brandes.name')
            ->groupBy('templet_brandes.name')
            ->get();
        $brandname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($brandname, $matched_result[$i]->name);
        }
        $brandname = array_diff($brandname, ['', 'null']);
        $matched_result = DB::table("brandes")->rightjoin('templet_brandes', 'brandes.code', '=', 'templet_brandes.code')
            ->where('brandes.code', '!=', null)
            ->select('templet_brandes.code')
            ->groupBy('templet_brandes.code')
            ->get();
        $brandcode = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($brandcode, $matched_result[$i]->code);
        }
        $brandcode = array_diff($brandcode, ['', 'null']);
        $count_error = count($brandname + $brandcode);
        if ($count_error > 0) {
            return view('admin.import.brand.error_brand', compact('brandname','brandcode'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet brand';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.brand.save_brand');
        }
    }

    public function SaveBrandGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_brand = TempletBrand::all();
        foreach ($templet_brand as $templet) {
            $newbrand = new Brand();
            $newbrand->name = $templet->name;
            $newbrand->code = $templet->code;
            $newbrand->order = $templet->order;
            $newbrand->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create brand';
            $log->data_change=$newbrand->name;
            $log->save();
        }
        return redirect('admin/brand')->with('message', 'Add Brand Is Done!');
    }
}

?>