<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletSizeImport;
use App\Models\Log;
use App\Models\Size;
use App\Models\TempletSize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletSizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletsize()
    {
        $templet_size = TempletSize::all();
        return view('admin.import.size.import_size_index', compact('templet_size'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/size');
    }

    public function importsizeget()
    {
        return view('admin.import.size.import_size');
    }

    public function importsizepost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletSize::truncate();
        Excel::import(new TempletSizeImport(), request()->file('file'));
        $templet_size = TempletSize::find(1);
        $templet_size->delete();
        return redirect('/admin/import/index/size')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedSizeGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("sizes")->rightjoin('templet_sizes', 'sizes.name', '=', 'templet_sizes.name')
            ->where('sizes.name', '!=', null)
            ->select('templet_sizes.name')
            ->groupBy('templet_sizes.name')
            ->get();
        $sizename = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($sizename, $matched_result[$i]->name);
        }
        $sizename = array_diff($sizename, ['', 'null']);
        $matched_result = DB::table("sizes")->rightjoin('templet_sizes', 'sizes.code', '=', 'templet_sizes.code')
            ->where('sizes.code', '!=', null)
            ->select('templet_sizes.code')
            ->groupBy('templet_sizes.code')
            ->get();
        $sizecode = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($sizecode, $matched_result[$i]->code);
        }
        $sizecode = array_diff($sizecode, ['', 'null']);
        $count_error = count($sizename + $sizecode);
        if ($count_error > 0) {
            return view('admin.import.size.error_size', compact('sizename','sizecode'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet size';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.size.save_size');
        }
    }

    public function SaveSizeGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_size = TempletSize::all();
        foreach ($templet_size as $templet) {
            $newsize = new Size();
            $newsize->name = $templet->name;
            $newsize->code = $templet->code;
            $newsize->order = $templet->order;
            $newsize->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create size';
            $log->data_change=$newsize->name;
            $log->save();
        }
        return redirect('admin/size')->with('message', 'Add Size Is Done!');
    }
}

?>