<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletColorImport;
use App\Models\Color;
use App\Models\Log;
use App\Models\TempletColor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletcolor()
    {
        $templet_color = TempletColor::all();
        return view('admin.import.color.import_color_index', compact('templet_color'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/color');
    }

    public function importcolorget()
    {
        return view('admin.import.color.import_color');
    }

    public function importcolorpost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletColor::truncate();
        Excel::import(new TempletColorImport(), request()->file('file'));
        $templet_color = TempletColor::find(1);
        $templet_color->delete();
        return redirect('/admin/import/index/color')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedColorGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("colores")->rightjoin('templet_colores', 'colores.name', '=', 'templet_colores.name')
            ->where('colores.name', '!=', null)
            ->select('templet_colores.name')
            ->groupBy('templet_colores.name')
            ->get();
        $colorname = [];

        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($colorname, $matched_result[$i]->name);
        }
        $colorname = array_diff($colorname, ['', 'null']);
        $count_error = count($colorname);
        if ($count_error > 0) {
            return view('admin.import.color.error_color', compact('colorname'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet color';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.color.save_color');
        }
    }

    public function SaveColorGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_color = TempletColor::all();
        foreach ($templet_color as $templet) {
            $newcolor = new Color();
            $newcolor->name = $templet->name;
            $newcolor->order = $templet->order;
            $newcolor->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create color';
            $log->data_change=$newcolor->name;
            $log->save();
        }
        return redirect('admin/color')->with('message', 'Add Color Is Done!');
    }
}

?>