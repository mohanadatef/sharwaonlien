<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Area\AreaCreateRequest;
use App\Http\Requests\admin\Area\AreaEditRequest;
use App\Models\Area;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexarea()
    {
        $area = Area::with('city')->get();
        return view('admin.area.area_index', compact('area'));
    }

    public function createareapost(AreaCreateRequest $request)
    {
        $newarea = new Area();
        $newarea->name = $request->input('name');
        $newarea->city_id = $request->input('city_id');
        $newarea->order = $request->input('order');
        $newarea->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create area';
        $log->data_change=$newarea->name . ',' . $newarea->city_id;
        $log->save();
        return redirect('admin/area')->with('message', 'Add Area Is Done!');
    }

    public function createareaget()
    {
        $city = DB::table("cities")->pluck("name", "id");
        return view('admin.area.area_create', compact('city'));
    }

    public function editareapost(AreaEditRequest $request, $id)
    {

        $newarea = Area::find($id);
        if($newarea->name != $request->input('name'))
        {
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit area';
        $log->data_change=$newarea->name ;
        $log->save();
        }
        $newarea->name = $request->input('name');
        if($newarea->city_id != $request->input('city_id'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit area';
            $log->data_change= $newarea->name .','.$newarea->city_id ;
            $log->save();
        }
        $newarea->city_id = $request->input('city_id');
        if($newarea->order != $request->input('order'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit area';
            $log->data_change= $newarea->name .','.$newarea->order ;
            $log->save();
        }
        $newarea->order = $request->input('order');
        $newarea->save();
        return redirect('admin/area')->with('message', 'Edit Area Is Done!');
    }

    public function editareaget($id)
    {
        $area = Area::find($id);
        $city = DB::table("cities")->pluck("name", "id");
        return view('admin.area.area_edit', compact('city', 'area'));
    }


}

?>