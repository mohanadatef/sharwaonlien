<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Bag\BagEditRequest;
use App\Http\Requests\admin\Bag\BagCreateRequest;
use App\Http\Requests\admin\Bag\ManageBagEditRequest;
use App\Models\Bag;
use App\Models\Log;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexbag()
    {
        $bag = Bag::orderBy('created_at', 'asc')->get();
       /* $count_1 = 0;
        foreach($bag as $bags)
        {
            if($bags->statues ==1)
                {
                 $count_1++;
           }
        }*/
        return view('admin.bag.bag_index', compact('bag'/*,'count_1'*/));
    }

 /*   public function indexbagcomplete()
    {
        $bag = Bag::where('complete','=','1')->with('supplier','user_buy','user_create')->get();
        return view('admin.bag.bag_complete_index', compact('bag'));
    }*/

    /*public function indexmanagebag()
    {
        $bag = Bag::all();
        return view('admin.bag.manage_bag_index', compact('bag'));
    }*/

/*    public function pricesmanagebag()
    {
        $bag = Bag::where('cost_profit', '=', 0)->ORwhere('cost_buy', '=', 0)->get();
        return view('admin.bag.manage_bag_prices', compact('bag'));
    }*/

    /*public function editmanagebagget($id)
    {
        $manage_bag = Bag::find($id);
        return view('admin.bag.manage_bag_edit', compact('manage_bag'));
    }

    public function editmanagebagpost(ManageBagEditRequest $request, $id)
    {
        $newmanagebag = Bag::find($id);
        if($newmanagebag->cost_buy != $request->input('cost_buy'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit manage bag';
            $log->data_change=$newmanagebag->name . ','.$newmanagebag->cost_buy ;
            $log->save();
        }
        $newmanagebag->cost_buy = $request->input('cost_buy');
        if($newmanagebag->cost_profit != $request->input('cost_profit'))
        {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit manage bag';
            $log->data_change=$newmanagebag->name . ','.$newmanagebag->cost_profit ;
            $log->save();
        }
        $newmanagebag->cost_profit = $request->input('cost_profit');
        $newmanagebag->save();
        return redirect('/admin/manage_bag')->with('message', 'Edit Bag Is Done!');
    }*/

    public function createbagget()
    {
        $supplier = DB::table("supplieres")->where('statues','=',1)->pluck("name", "id");
        $user = User::with('role')->get();
        $bag = Bag::all()->last();
        if ($bag == null) {
            $id = 1;
        } else {
            $id = $bag->id + 1;
        }
        return view('admin.bag.bag_create', compact('id', 'supplier','user'));
    }

    public function createbagpost(BagCreateRequest $request)
    {
        $bag = Bag::all()->last();
        if ($bag == null) {
            $id = 1;
        } else {
            $id = $bag->id + 1;
        }
        $newbag = new Bag();
        $data['name'] = 'bag' . $id;
        $data['statues'] = 0;
        $data['complete'] = 0;
        $data['count_item'] = 0;
        $data['user_create_id'] =Auth::user()->id;
        $newbag->create(array_merge($request->all(),$data));
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create bag';
        $log->data_change=$data['name'];
        $log->save();
        return redirect('/admin/bag')->with('message', 'Add Bag Is Done!');
    }

    public function editbagget($id)
    {
        $bag = Bag::find($id);
        $supplier = DB::table("supplieres")->where('statues','=',1)->pluck("name", "id");
        $user = User::with('role')->get();
        return view('admin.bag.bag_edit', compact('bag', 'supplier','user'));
    }

    public function editbagpost(BagEditRequest $request, $id)
    {
        $newbag = Bag::find($id);
        $newbag->update($request->all());
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit bag';
        $log->data_change=$newbag->name;
        $log->save();
        return redirect('/admin/bag')->with('message', 'Edit Bag Is Done!');
    }

    public function editstatues($id)
    {
        $newbag = Bag::find($id);
        if ($newbag->statues == 1) {
            $newbag->statues = '0';
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit statues bag';
            $log->data_change=$newbag->name .','.$newbag->statues;
            $log->save();
        } elseif ($newbag->statues == 0) {
            $newbag->statues = '1';
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit statues bag';
            $log->data_change=$newbag->name .','.$newbag->statues;
            $log->save();
        }
        $newbag->save();
        return redirect('/admin/bag')->with('message', 'Edit Statues Is Done!');
    }

   /* public function editcomplete($id)
    {
        $newbag = Bag::find($id);
        if ($newbag->complete == 1) {
            $newbag->complete = '0';
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit complete bag';
            $log->data_change=$newbag->name .','.$newbag->complete;
            $log->save();
        } elseif ($newbag->complete == 0) {
            $newbag->complete = '1';
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit complete bag';
            $log->data_change=$newbag->name .','.$newbag->complete;
            $log->save();
        }
        if ($newbag->statues == 1) {
            $newbag->statues = '0';
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='edit statues bag becouse compelet';
            $log->data_change=$newbag->name .','.$newbag->complete;
            $log->save();
        }
        $newbag->save();
        return redirect('/admin/bag')->with('message', 'Edit Statues Is Done!');
    }*/




}

?>