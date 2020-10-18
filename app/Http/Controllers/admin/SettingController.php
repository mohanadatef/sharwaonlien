<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Setting\SettingCreateRequest;
use App\Http\Requests\admin\Setting\SettingEditRequest;
use App\Models\Log;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexsetting()
    {
        $setting = Setting::all();
        return view('admin.setting.setting_index', compact('setting'));
    }

    public function createsettingpost(SettingCreateRequest $request)
    {
        $setting = new Setting();
        $setting->facebook = $request->input('facebook');
        $setting->instgram = $request->input('instgram');
        $imageName = time() . '.' . Request()->image->getClientOriginalExtension();
        Request()->image->move(public_path('images/setting'), $imageName);
        $setting->image = ($imageName);
        $imageName_log = time() . '-logo.' . Request()->logo->getClientOriginalExtension();
        Request()->logo->move(public_path('images/setting'), $imageName_log);
        $setting->logo = ($imageName_log);
        $setting->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create setting';
        $log->data_change='    ';
        $log->save();
        return redirect('/admin/setting')->with('message', 'Add Is Done!');
    }

    public function createsettingget()
    {
        return view('admin.setting.setting_create');
    }

    public function editsettingpost(SettingEditRequest $request, $id)
    {
        $setting = Setting::find($id);
        $setting->facebook = $request->input('facebook');
        $setting->instgram = $request->input('instgram');
        if ($request->image != null) {
            $imageName = time() . '.' . Request()->image->getClientOriginalExtension();
            Request()->image->move(public_path('images/setting'), $imageName);
            $setting->image = ($imageName);
        }
        if ($request->logo != null) {
            $imageName = time() . '-logo.' . Request()->logo->getClientOriginalExtension();
            Request()->logo->move(public_path('images/setting'), $imageName);
            $setting->logo = ($imageName);
        }
        $setting->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit setting';
        $log->data_change='    ';
        $log->save();
        return redirect('/admin/setting')->with('message', 'Edit Is Done!');
    }

    public function editsettingget($id)
    {
        $setting = Setting::find($id);
        return view('admin.setting.setting_edit', compact('setting'));
    }

}

?>