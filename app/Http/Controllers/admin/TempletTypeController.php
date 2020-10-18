<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletTypeImport;
use App\Models\Log;
use App\Models\Type;
use App\Models\TempletType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextemplettype()
    {
        $templet_type = TempletType::all();
        return view('admin.import.type.import_type_index', compact('templet_type'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/type');
    }

    public function importtypeget()
    {
        return view('admin.import.type.import_type');
    }

    public function importtypepost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletType::truncate();
        Excel::import(new TempletTypeImport(), request()->file('file'));
        $templet_type = TempletType::find(1);
        $templet_type->delete();
        return redirect('/admin/import/index/type')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedTypeGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("types")->rightjoin('templet_types', 'types.name', '=', 'templet_types.name')
            ->where('types.name', '!=', null)
            ->select('templet_types.name')
            ->groupBy('templet_types.name')
            ->get();
        $typename = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($typename, $matched_result[$i]->name);
        }
        $typename = array_diff($typename, ['', 'null']);
        $count_error = count($typename );
        if ($count_error > 0) {
            return view('admin.import.type.error_type', compact('typename'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet type';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.type.save_type');
        }
    }

    public function SaveTypeGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_type = TempletType::all();
        foreach ($templet_type as $templet) {
            $newtype = new Type();
            $newtype->name = $templet->name;
            $newtype->order = $templet->order;
            $newtype->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create type';
            $log->data_change=$newtype->name;
            $log->save();
        }
        return redirect('admin/type')->with('message', 'Add Type Is Done!');
    }
}

?>