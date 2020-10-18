<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Call_Us;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class CallUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexcallus()
    {
        $call_us = Call_Us::all();
        return view('admin.call_us.call_us_index',compact('call_us'));
    }
    public function deletecallus($id)
    {
        $callus = Call_Us::find($id);
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='delete Call Us';
        $log->data_change=$callus->	message;
        $log->save();
        $callus->delete();
        return redirect()->back()->with('message', 'Delete request Is Done!');
    }
}

?>