<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletCategoryTypeImport;
use App\Models\CategoryType;
use App\Models\Log;
use App\Models\TempletCategoryType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletCategoryTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletcategorytype()
    {
        $templet_category_type = TempletCategoryType::all();
        return view('admin.import.category_type.import_category_type_index', compact('templet_category_type'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/description');
    }

    public function importcategorytypeget()
    {
        return view('admin.import.category_type.import_category_type');
    }

    public function importcategorytypepost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletCategoryType::truncate();
        Excel::import(new TempletCategoryTypeImport(), request()->file('file'));
        $templet_category_type = TempletCategoryType::find(1);
        $templet_category_type->delete();
        return redirect('/admin/import/index/description')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedCategoryTypeGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("category_types")->rightjoin('templet_category_types', 'category_types.name', '=', 'templet_category_types.name')
            ->where('category_types.name', '!=', null)
            ->select('templet_category_types.name')
            ->groupBy('templet_category_types.name')
            ->get();
        $category_typename = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($category_typename, $matched_result[$i]->name);
        }
        $category_typename = array_diff($category_typename, ['', 'null']);
        $count_error = count($category_typename );
        if ($count_error > 0) {
            return view('admin.import.category_type.error_category_type', compact('category_typename'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet category type';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.category_type.save_category_type');
        }
    }

    public function SaveCategoryTypeGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_category_type = TempletCategoryType::all();
        foreach ($templet_category_type as $templet) {
            $newcategorytype = new CategoryType();
            $newcategorytype->name = $templet->name;
            $newcategorytype->order = $templet->order;
            $newcategorytype->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create categorytype';
            $log->data_change=$newcategorytype->name;
            $log->save();
        }
        return redirect('admin/description')->with('message', 'Add Category Type Is Done!');
    }
}

?>