<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Brand\BrandEditRequest;
use App\Http\Requests\admin\Brand\BrandCreateRequest;
use App\Models\Brand;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexbrand()
    {
        $brand = Brand::all();
        return view('admin.brand.brand_index', compact('brand'));
    }

    public function createbrandpost(brandCreateRequest $request)
    {
        $newbrand = new Brand();
        $newbrand->name = $request->input('name');
        $newbrand->order = $request->input('order');
        $newbrand->code = $request->input('code');
        $newbrand->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create brand';
        $log->data_change=$newbrand->name;
        $log->save();
        return redirect('/admin/brand')->with('message', 'Add Brand Is Done!');
    }

    public function createbrandget()
    {
        return view('admin.brand.brand_create');
    }

    public function editbrandpost(BrandEditRequest $request, $id)
    {
        $newbrand = Brand::find($id);
        if($newbrand->name != $request->input('name'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit brand';
            $log->data_change=$newbrand->name ;
            $log->save();
        }
        $newbrand->name = $request->input('name');
        if($newbrand->order != $request->input('order'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit brand';
            $log->data_change=$newbrand->name .','.$newbrand->order ;
            $log->save();
        }
        $newbrand->order = $request->input('order');
        if($newbrand->code != $request->input('code'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit brand';
            $log->data_change=$newbrand->name .','.$newbrand->code ;
            $log->save();
        }
        $newbrand->code = $request->input('code');
        $newbrand->save();
        return redirect('/admin/brand')->with('message', 'Edit Brand Is Done!');
    }

    public function editbrandget($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.brand_edit', compact('brand'));
    }

}

?>