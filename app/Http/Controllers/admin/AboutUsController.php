<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\About_Us\AboutUsEditRequest;
use App\Models\AboutUs;
use App\Http\Requests\admin\About_Us\AboutUsCreateRequest;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexaboutus()
    {
        $aboutus = AboutUs::all();
        return view('admin.about_us.about_us_index', compact('aboutus'));
    }

    public function createaboutusget()
    {
        return view('admin.about_us.about_us_create');
    }

    public function createaboutuspost(AboutUsCreateRequest $request)
    {
        $aboutus = new AboutUs();
        $aboutus->description = $request->input('description');
        $imageName = time() . '.' . Request()->image->getClientOriginalExtension();
        Request()->image->move(public_path('images/about_us'), $imageName);
        $aboutus->image = ($imageName);
        $aboutus->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create About Us';
        $log->data_change=$aboutus->description;
        $log->save();
        return redirect('/admin/about_us')->with('message', 'Add About us Is Done!');
    }

    public function editaboutusget($id)
    {
        $aboutus = AboutUs::find($id);
        return view('admin.about_us.about_us_edit', compact('aboutus'));
    }

    public function editaboutuspost(AboutUsEditRequest $request, $id)
    {
        $aboutus = AboutUs::find($id);
        $aboutus->description = $request->input('description');
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='Edit About Us';
        $log->data_change=$aboutus->description;
        $log->save();
        if($request->image != null)
        {
            $imageName = time() . '.' . Request()->image->getClientOriginalExtension();
            Request()->image->move(public_path('images/about_us'), $imageName);
            $aboutus->image = ($imageName);
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='Edit About Us';
            $log->data_change=$aboutus->image;
            $log->save();
        }
            $aboutus->save();
            return redirect('/admin/about_us')->with('message', 'Edit Is Done!');

    }
}

?>