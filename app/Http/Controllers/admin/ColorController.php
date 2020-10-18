<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Color\ColorEditRequest;
use App\Http\Requests\admin\Color\ColorCreateRequest;
use App\Models\Color;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexcolor()
    {
        $color = Color::all();
        return view('admin.color.color_index',compact('color'));
    }
    public function createcolorpost(ColorCreateRequest $request)
    {
            $newcolor=new Color();
        $newcolor->name = $request->input('name');
        $newcolor->order = $request->input('order');
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create color';
        $log->data_change=$newcolor->name;
        $log->save();
        $newcolor->save();
            return redirect('/admin/color')->with('message', 'Add Color Is Done!');
        }
        public function createcolorget()
        {
            return view('admin.color.color_create');
        }
    public function editcolorpost(ColorEditRequest $request,$id)
    {
        $newcolor = Color::find($id);
        if($newcolor->name != $request->input('name'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit color';
            $log->data_change=$newcolor->name ;
            $log->save();
        }
        $newcolor->name = $request->input('name');
        if($newcolor->order != $request->input('order'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit color';
            $log->data_change=$newcolor->name .','.$newcolor->order ;
            $log->save();
        }
        $newcolor->order = $request->input('order');
        $newcolor->save();
            return redirect('/admin/color')->with('message', 'Edit Color Is Done!');
        }
    public function editcolorget($id)
        {
            $color = Color::find($id);
            return view('admin.color.color_edit',compact('color'));
        }

}

?>