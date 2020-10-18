<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Supplier\SupplierEditRequest;
use App\Http\Requests\admin\Supplier\SupplierCreateRequest;
use App\Models\Log;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;


class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function indexsupplier()
    {
        $supplier = Supplier::all();
        return view('admin.supplier.supplier_index', compact('supplier'));
    }

    public function createsupplierpost(SupplierCreateRequest $request)
    {
        $newsupplier = new Supplier();
        $newsupplier->name = $request->input('name');
        $newsupplier->mobile = $request->input('mobile');
        $newsupplier->address = $request->input('address');
        $newsupplier->email = $request->input('email');
        $newsupplier->statues = 1;
        $newsupplier->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='create supplier';
        $log->data_change=$newsupplier->name;
        $log->save();
        return redirect('/admin/supplier')->with('message', 'Add Supplier Is Done!');
    }

    public function createsupplierget()
    {
        return view('admin.supplier.supplier_create');
    }

    public function editsupplierpost(SupplierEditRequest $request, $id)
    {
        $newsupplier = Supplier::find($id);
        $newsupplier->name = $request->input('name');
        $newsupplier->mobile = $request->input('mobile');
        $newsupplier->address = $request->input('address');
        $newsupplier->email = $request->input('email');
        $newsupplier->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='edit supplier';
        $log->data_change=$newsupplier->name;
        $log->save();
        return redirect('/admin/supplier')->with('message', 'Edit Supplier Is Done!');
    }

    public function editsupplierget($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.supplier.supplier_edit', compact('supplier'));
    }

    public function showsupplier($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.supplier.supplier_show', compact('supplier'));
    }


    public function editstatues($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier->statues == 1) {
            $supplier->statues = '0';
        } elseif ($supplier->statues == 0) {
            $supplier->statues = '1';
        }
        $supplier->save();
        $log = new Log();
        $log->user_id=Auth::user()->id;
        $log->action_status='change status supplier';
        $log->data_change=$supplier->name;
        $log->save();
        return redirect('/admin/supplier')->with('message', 'Edit Statues Is Done!');
    }
}

?>