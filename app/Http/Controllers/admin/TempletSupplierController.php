<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletSupplierImport;
use App\Models\Log;
use App\Models\Supplier;
use App\Models\TempletSupplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletSupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletsupplier()
    {
        $templet_supplier = TempletSupplier::all();
        return view('admin.import.supplier.import_supplier_index', compact('templet_supplier'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/supplier');
    }

    public function importsupplierget()
    {
        return view('admin.import.supplier.import_supplier');
    }

    public function importsupplierpost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletSupplier::truncate();
        Excel::import(new TempletSupplierImport(), request()->file('file'));
        $templet_supplier = TempletSupplier::find(1);
        $templet_supplier->delete();
        return redirect('/admin/import/index/supplier')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedSupplierGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("supplieres")->rightjoin('templet_supplieres', 'supplieres.name', '=', 'templet_supplieres.name')
            ->where('supplieres.name', '!=', null)
            ->select('templet_supplieres.name')
            ->groupBy('templet_supplieres.name')
            ->get();
        $suppliername = [];

        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($suppliername, $matched_result[$i]->name);
        }
        $suppliername = array_diff($suppliername, ['', 'null']);
        $count_error = count($suppliername);
        if ($count_error > 0) {
            return view('admin.import.supplier.error_supplier', compact('suppliername'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet supllier';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.supplier.save_supplier');
        }
    }

    public function SaveSupplierGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_supplier = TempletSupplier::all();
        foreach ($templet_supplier as $templet) {
            $newsupplier = new Supplier();
            $newsupplier->name = $templet->name;
            $newsupplier->mobile = $templet->mobile;
            $newsupplier->address = $templet->address;
            $newsupplier->statues = 1;
            if($templet->email != null)
            {
            $newsupplier->email = $templet->email;
            }
            else
            {
                $newsupplier->email ="  ";
            }
            $newsupplier->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create supplier';
            $log->data_change=$newsupplier->name;
            $log->save();
        }
        return redirect('admin/supplier')->with('message', 'Add Supplier Is Done!');
    }
}

?>