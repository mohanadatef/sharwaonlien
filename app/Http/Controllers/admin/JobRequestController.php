<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\JobRequest;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexjobrequest()
    {
        $job_request = JobRequest::with('job')->get();
        return view('admin.job_request.job_request_index',compact('job_request'));
    }
    public function deletejobrequest($id)
    {
        $job_request = JobRequest::find($id);
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='delete job request';
        $log->data_change=$job_request->first_name ;
        $log->save();
        $job_request->delete();
        return redirect()->back()->with('message', 'Delete service Is Done!');
    }
}

?>