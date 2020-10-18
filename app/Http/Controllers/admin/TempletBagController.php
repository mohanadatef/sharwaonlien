<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletBagImport;
use App\Models\Bag;
use App\Models\Log;
use App\Models\Supplier;
use App\Models\TempletBag;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletBagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletbag()
    {
        $templet_bag = TempletBag::all();
        return view('admin.import.bag.import_bag_index', compact('templet_bag'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/bag');
    }

    public function importbagget()
    {
        return view('admin.import.bag.import_bag');
    }

    public function importbagpost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletBag::truncate();
        Excel::import(new TempletBagImport(), request()->file('file'));
        $templet_bag = TempletBag::find(1);
        $templet_bag->delete();
        return redirect('/admin/import/index/bag')->with('message', 'Add Templet Is Done!');
    }

    public function unmatchedBagGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("bags")->rightjoin('templet_bags', 'bags.name', '=', 'templet_bags.name')
            ->where('bags.name', '!=', null)
            ->select('templet_bags.name')
            ->groupBy('templet_bags.name')
            ->get();
        $bagname = [];
        foreach($matched_result as $x)
        {
            array_push($bagname, $x->name);
        }
        $bagname = array_diff($bagname, ['', 'null']);
        $matched_result = DB::table("supplieres")->rightjoin('templet_bags', 'supplieres.name', '=', 'templet_bags.supplier')
            ->where('supplieres.name', '=', null)
            ->select('templet_bags.supplier')
            ->groupBy('templet_bags.supplier')
            ->get();
        $suppliername = [];
        foreach($matched_result as $x)
        {
            foreach($x as $xz) {
                array_push($suppliername, $xz);
            }
        }
        $suppliername = array_diff($suppliername, [ 'null']);
        $matched_result = DB::table("users")->rightjoin('templet_bags', 'users.name', '=', 'templet_bags.user_buy')
            ->where('users.name', '=', null)
            ->select('templet_bags.user_buy')
            ->groupBy('templet_bags.user_buy')
            ->get();
        $username = [];
        foreach($matched_result as $x)
        {
            array_push($username, $x->name);
        }
        $username = array_diff($username, [ 'null']);
        $count_error = count($bagname+$suppliername+$username);
        if ($count_error > 0) {
            return view('admin.import.bag.error_bag', compact('bagname','suppliername','username'));
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='import sheet bag';
            $log->data_change='      ' ;
            $log->save();
            return view('admin.import.bag.save_bag');
        }
    }

    public function SaveBagGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_bag = TempletBag::all();
        foreach ($templet_bag as $templet) {
            $newbag = new Bag();
            $newbag->name = $templet->name;
            $newbag->weight = $templet->weight;
            $newbag->cost_profit = $templet->cost_profit;
            $newbag->cost_buy = $templet->cost_buy;
            $newbag->count_item = 0;
            $newbag->statues = 0;
            $newbag->complete = 0;
            $supplier = Supplier::where('name', $templet->supplier)->first();
            $newbag->supplier_id = $supplier->id;
            $user = User::where('name', $templet->user_buy)->first();
            $newbag->user_buy_id = $user->id;
            $newbag->user_create_id =Auth::User()->id;
            $newbag->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='create bag';
            $log->data_change=$newbag->name;
            $log->save();
        }
        return redirect('admin/bag')->with('message', 'Add Bag Is Done!');
    }
}

?>