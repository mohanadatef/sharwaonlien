<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Size\SizeEditRequest;
use App\Http\Requests\admin\Size\SizeCreateRequest;
use App\Models\Log;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;


class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexsize()
    {
        $size = Size::all();
        return view('admin.size.size_index', compact('size'));
    }

    public function createsizepost(SizeCreateRequest $request)
    {
        $newsize = new Size();
        $newsize->create($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create size';
        $log->data_change=$request->name;
        $log->save();
        return redirect('/admin/size')->with('message', 'Add Size Is Done!');
    }

    public function createsizeget()
    {
        return view('admin.size.size_create');
    }

    public function editsizepost(SizeEditRequest $request, $id)
    {
        $newsize = Size::find($id);
        $newsize->update($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit size';
        $log->data_change=$newsize->name;
        $log->save();
        return redirect('/admin/size')->with('message', 'Edit Size Is Done!');
    }

    public function editsizeget($id)
    {
        $size = Size::find($id);
        return view('admin.size.size_edit', compact('size'));
    }

}

?>