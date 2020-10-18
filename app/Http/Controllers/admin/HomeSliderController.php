<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Home_Slider\HomeSliderCreateRequest;
use App\Http\Requests\admin\Home_Slider\HomeSliderEditRequest;
use App\Models\Home_Slider;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class HomeSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexhomeslider()
    {
        $homeslider = Home_Slider::orderby('order')->get();
        return view('admin.home_slider.home_slider_index', compact('homeslider'));
    }

    public function createhomesliderget()
    {
        return view('admin.home_slider.home_slider_create');
    }

    public function createhomesliderpost(HomeSliderCreateRequest $request)
    {
        $newhomeslider = new Home_Slider();
        $newhomeslider->order = $request->input('order');
        $imageName = time() . '.' . Request()->image->getClientOriginalExtension();
        Request()->image->move(public_path('images/home_slider'), $imageName);
        $newhomeslider->image = ($imageName);
        $newhomeslider->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create home slider';
        $log->data_change=$newhomeslider->id ;
        $log->save();
        return redirect('/admin/home_slider')->with('message', 'Add Home Slider Is Done!');
    }

    public function edithomesliderget($id)
    {
        $homeslider = Home_Slider::find($id);
        return view('admin.home_slider.home_slider_edit', compact('homeslider'));
    }

    public function edithomesliderpost(HomeSliderEditRequest $request, $id)
    {
        $newhomeslider = Home_Slider::find($id);
        $newhomeslider->order = $request->input('order');
        if ($request->image != null) {
            $imageName = time() . '.' . Request()->image->getClientOriginalExtension();
            Request()->image->move(public_path('images/home_slider'), $imageName);
            $newhomeslider->image = ($imageName);
        }
            $newhomeslider->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit home slider';
        $log->data_change=$newhomeslider->id ;
        $log->save();
            return redirect('/admin/home_slider')->with('message', 'Edit Home Slider Is Done!');

    }

    public function deletehomeslider($id)
    {
        $homeslider = Home_Slider::find($id);
        $homeslider->delete();
        return redirect()->back()->with('message', 'Delete Home Slider Is Done!');
    }
}

?>