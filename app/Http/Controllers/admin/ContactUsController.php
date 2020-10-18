<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Contact_Us\ContactUsCreateRequest;
use App\Http\Requests\admin\Contact_Us\ContactUsEditRequest;
use App\Models\ContactUs;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexcontactus()
    {
        $contactus = ContactUs::all();
        return view('admin.contact_us.contact_us_index', compact('contactus'));
    }

    public function createcontactuspost(ContactUsCreateRequest $request)
    {
        $newcontactus = new ContactUs();
        $newcontactus->create($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create contact us';
        $log->data_change=$newcontactus->address ;
        $log->save();
        return redirect('/admin/contact_us')->with('message', 'Add Is Done!');
    }

    public function createcontactusget()
    {
        return view('admin.contact_us.contact_us_create');
    }

    public function editcontactuspost(ContactUsEditRequest $request, $id)
    {
        $newcontactus = ContactUs::find($id);
        $newcontactus->update($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit contact us';
        $log->data_change=$request->address ;
        $log->save();
        return redirect('/admin/contact_us')->with('message', 'Edit contact_us Is Done!');
    }

    public function editcontactusget($id)
    {
        $contactus = contactus::find($id);
        return view('admin.contact_us.contact_us_edit', compact('contactus'));
    }

}

?>