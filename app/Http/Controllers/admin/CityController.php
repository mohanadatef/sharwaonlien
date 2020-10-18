<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\City\CityEditRequest;
use App\Http\Requests\admin\City\CityCreateRequest;
use App\Models\City;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexcity()
    {
        $city = City::orderBy('order')->get();
        return view('admin.city.city_index', compact('city'));
    }

    public function createcitypost(CityCreateRequest $request)
    {
        $newcity = new City();
        $newcity->name = $request->input('name');
        $newcity->order = $request->input('order');
        $newcity->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create city';
        $log->data_change=$newcity->name;
        $log->save();
        return redirect('/admin/city')->with('message', 'Add City Is Done!');
    }

    public function createcityget()
    {
        return view('admin.city.city_create');
    }

    public function editcitypost(CityEditRequest $request, $id)
    {
        $newcity = City::find($id);
        if($newcity->name != $request->input('name'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit city';
            $log->data_change=$newcity->name ;
            $log->save();
        }
        $newcity->name = $request->input('name');
        if($newcity->order != $request->input('order'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit city';
            $log->data_change=$newcity->name .','.$newcity->order ;
            $log->save();
        }
        $newcity->order = $request->input('order');
        $newcity->save();
        return redirect('/admin/city')->with('message', 'Edit City Is Done!');
    }

    public function editcityget($id)
    {
        $city = City::find($id);
        return view('admin.city.city_edit', compact('city'));
    }

}

?>