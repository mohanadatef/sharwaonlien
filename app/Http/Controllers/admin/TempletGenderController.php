<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletGenderImport;
use App\Models\Gender;
use App\Models\Log;
use App\Models\TempletGender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletGenderController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletgender()
    {
        $templet_gender = TempletGender::all();
        return view('admin.import.gender.import_gender_index', compact('templet_gender'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/gender');
    }

    public function importgenderget()
    {
        return view('admin.import.gender.import_gender');
    }

    public function importgenderpost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletGender::truncate();
        Excel::import(new TempletGenderImport(), request()->file('file'));
        $templet_gender = TempletGender::find(1);
        $templet_gender->delete();
        return redirect('/admin/import/index/gender')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedGenderGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("genderes")->rightjoin('templet_genderes', 'genderes.name', '=', 'templet_genderes.name')
            ->where('genderes.name', '!=', null)
            ->select('templet_genderes.name')
            ->groupBy('templet_genderes.name')
            ->get();
        $gendername = [];

        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($gendername, $matched_result[$i]->name);
        }
        $gendername = array_diff($gendername, ['', 'null']);
        $count_error = count($gendername);
        if ($count_error > 0) {
            return view('admin.import.gender.error_gender', compact('gendername'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet gender';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.gender.save_gender');
        }
    }

    public function SaveGenderGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_gender = TempletGender::all();
        foreach ($templet_gender as $templet) {
            $newgender = new Gender();
            $newgender->name = $templet->name;
            $newgender->order = $templet->order;
            $newgender->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create gender';
            $log->data_change=$newgender->name;
            $log->save();
        }
        return redirect('admin/gender')->with('message', 'Add Gender Is Done!');
    }*/
}

?>