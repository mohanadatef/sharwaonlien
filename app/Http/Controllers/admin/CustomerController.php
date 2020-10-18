<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\User;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexcustomer()
    {
        $customer = Customer::all();
        return view('admin.customer.customer_index',compact('customer'));
    }


}

?>