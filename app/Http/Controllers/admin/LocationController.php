<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Location\LocationEditRequest;
use App\Http\Requests\admin\Location\LocationCreateRequest;
use App\Models\Location;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexlocation()
    {
        $location = Location::where('id','!=',1)->get();
        return view('admin.location.location_index', compact('location'));
    }

    public function createlocationpost(LocationCreateRequest $request)
    {
        $newlocation = new Location();
        $newlocation->name = $request->input('name');
        $newlocation->space = $request->input('space');
        $newlocation->count_item = 0;
        $newlocation->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create Location';
        $log->data_change=$newlocation->name ;
        $log->save();
        return redirect('/admin/location')->with('message', 'Add Location Is Done!');
    }

    public function createlocationget()
    {
        return view('admin.location.location_create');
    }

    public function editlocationpost(LocationEditRequest $request, $id)
    {
        $newlocation = location::find($id);
        $newlocation->name = $request->input('name');
        $newlocation->space = $request->input('space');
        $newlocation->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit Location';
        $log->data_change=$newlocation->name ;
        $log->save();
        return redirect('/admin/location')->with('message', 'Edit Location Is Done!');
    }

    public function editlocationget($id)
    {
        $location = Location::find($id);
        return view('admin.location.location_edit', compact('location'));
    }

}

?>