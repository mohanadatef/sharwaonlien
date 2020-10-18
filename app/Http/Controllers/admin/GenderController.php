<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Gender\GenderEditRequest;
use App\Http\Requests\admin\Gender\GenderCreateRequest;
use App\Models\Gender;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class GenderController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexgender()
    {
        $gender = Gender::all();
        return view('admin.gender.gender_index',compact('gender'));
    }
    public function creategenderpost(GenderCreateRequest $request)
    {
            $newgender=new Gender();
        $newgender->name = $request->input('name');
        $newgender->order = $request->input('order');
        $newgender->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create gender';
        $log->data_change=$newgender->name ;
        $log->save();
            return redirect('/admin/gender')->with('message', 'Add Gender Is Done!');
        }
        public function creategenderget()
        {
            return view('admin.gender.gender_create');
        }
    public function editgenderpost(GenderEditRequest $request,$id)
    {
            $newgender = Gender::find($id);
        $newgender->name = $request->input('name');
        $newgender->order = $request->input('order');
        $newgender->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit gender';
        $log->data_change=$newgender->name ;
        $log->save();
            return redirect('/admin/gender')->with('message', 'Edit Gender Is Done!');
        }
    public function editgenderget($id)
        {
            $gender = Gender::find($id);
            return view('admin.gender.gender_edit',compact('gender'));
        }*/

}

?>