<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Job\JobCreateRequest;
use App\Http\Requests\admin\Job\JobEditRequest;
use App\Models\Job;
use App\Models\JobRequest;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexjob()
    {
        $job = Job::orderby('order')->get();
        return view('admin.job.job_index', compact('job'));
    }

    public function createjobpost(JobCreateRequest $request)
    {
        $newjob = new Job();
        $newjob->create($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create job';
        $log->data_change=$newjob->tittel ;
        $log->save();
        return redirect('/admin/job')->with('message', 'Add job Is Done!');
    }

    public function createjobget()
    {
        return view('admin.job.job_create');
    }

    public function editjobpost(JobEditRequest $request, $id)
    {
        $newjob = Job::find($id);
        $newjob->update($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit job';
        $log->data_change=$newjob->tittel ;
        $log->save();
        return redirect('/admin/job')->with('message', 'Edit job Is Done!');
    }

    public function editjobget($id)
    {
        $job = job::find($id);
        return view('admin.job.job_edit', compact('job'));
    }

    public function deletejob($id)
    {
        $jobrequest = JobRequest::where('job_id', $id);
        $jobrequest->delete();
        $job = Job::find($id);
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='delete job';
        $log->data_change=$job->tittel ;
        $log->save();
        $job->delete();
        return redirect()->back()->with('message', 'Delete job Is Done!');
    }
}

?>