<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Role_user;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $role=Role_user::where('user_id','=',Auth::User()->id)->first();
        if ($role->role_id =='6') {
            return redirect('/');
        } else {
            $order_preparation = 0;
            $order_ready = 0;
            $order_must_pay = 0;
            $order_preparation_all = 0;
            $order_ready_all = 0;
            $order_all = 0;
            $order_must_pay_all = 0;
            $order = Order::where('user_create_order_id', Auth::User()->id)->where('statues',10)->count();
            $order_all_1 = Order::where('statues',10)->get();
            foreach ($order_all_1 as $orderall) {
                $order_all = $order_all + $orderall->total_cost;
            }
            $order_preparation_1 = Order::where('user_create_order_id', Auth::User()->id)->where('statues', 1)->get();
            foreach ($order_preparation_1 as $orderpreparation) {
                $order_preparation = $order_preparation + $orderpreparation->total_cost;
            }
            $order_preparation_1 = Order::where('statues', 1)->get();
            foreach ($order_preparation_1 as $orderpreparation) {
                $order_preparation_all = $order_preparation_all + $orderpreparation->total_cost;
            }
            $order_ready_1 = Order::where('user_create_order_id', Auth::User()->id)->where('statues', 2)->get();
            foreach ($order_ready_1 as $orderready) {
                $order_ready = $order_ready + $orderready->total_cost;
            }
            $order_ready_1 = Order::where('statues', 2)->get();
            foreach ($order_ready_1 as $orderready) {
                $order_ready_all = $order_ready_all + $orderready->total_cost;
            }
            $order_must_pay_1 = Order::where('user_create_order_id', Auth::User()->id)->where('statues', 3)->get();
            foreach ($order_must_pay_1 as $ordermustpay) {
                $order_must_pay = $order_must_pay + $ordermustpay->total_cost;
            }
            $order_must_pay_1 = Order::where('statues', 3)->orwhere('statues', 4)->get();
            foreach ($order_must_pay_1 as $ordermustpay) {
                $order_must_pay_all = $order_must_pay_all + $ordermustpay->total_cost;
            }
            $order_edit = Order::where('user_create_order_id', Auth::User()->id)->where('statues', 7)->count();
            $order_edit_all = Order::where('statues', 7)->count();
            $order_discarded = Order::where('user_create_order_id', Auth::User()->id)->where('statues', 11)->count();
            $order_discarded_all = Order::where('statues', 11)->count();
            return view('admin.admin', compact('order', 'order_preparation', 'order_ready', 'order_must_pay', 'order_edit'
                , 'order_all', 'order_preparation_all', 'order_ready_all', 'order_must_pay_all', 'order_edit_all', 'order_discarded', 'order_discarded_all'));
        }
    }


}

?>