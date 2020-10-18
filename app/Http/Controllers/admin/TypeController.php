<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Type\TypeCreateRequest;
use App\Http\Requests\admin\Type\TypeEditRequest;
use App\Models\Log;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indextype()
    {
        $type = Type::all();
        return view('admin.type.type_index', compact('type'));
    }

    public function createtypepost(TypeCreateRequest $request)
    {
        $newtype = new Type();
        $newtype->name = $request->input('name');
        $newtype->order = $request->input('order');
        $newtype->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create type';
        $log->data_change=$newtype->name;
        $log->save();
        return redirect('admin/type')->with('message', 'Add Type Is Done!');
    }

    public function createtypeget()
    {
        return view('admin.type.type_create');
    }

    public function edittypepost(TypeEditRequest $request, $id)
    {

        $newtypees = Type::find($id);
        $newtypees->name = $request->input('name');
        $newtypees->order = $request->input('order');
        $newtypees->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit type';
        $log->data_change=$newtypees->name;
        $log->save();
        return redirect('admin/type')->with('message', 'Edit Type Is Done!');
    }

    public function edittypeget($id)
    {
        $type = Type::find($id);
        return view('admin.type.type_edit', compact( 'type'));
    }


}

?>