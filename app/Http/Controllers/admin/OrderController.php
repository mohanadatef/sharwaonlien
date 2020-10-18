<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Order\Finish_Request;
use App\Models\Account_Company;
use App\Models\Account_User;
use App\Models\Company_Delivery;
use App\Models\ContactUs;
use App\Models\Item;
use App\Models\Log;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\PricesDelivery;
use App\Models\Setting;
use App\User;
use Elibyy\TCPDF\TCPDF;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function doneorderpost(Finish_Request $request, $id)
    {
        $order = Order::find($id);
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->user_create_order_id = Auth::user()->id;
        if ($request->input('notes') != null) {
            $order->notes = $request->input('notes');
        }
        $order->mobile = $request->input('mobile');
        $order->delivery = $request->input('delivery');
        if ($request->input('delivery') == 0) {
            $order->user_take_id = Auth::user()->id;
        } elseif ($request->input('delivery') == 3) {
            $order->client = 3;
        }
        $order->statues = 1;
        $order->update();
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'finish order';
        $log->data_change = $order->id;
        $log->save();
        return redirect('/admin/cart_item/make_order')->with('message', 'order done');
    }

    public function ordermakereadyget()
    {
        $order = Order::with('user_create_order', 'company_delivery')->where('statues', '=', 1)->orwhere('statues', '=', 7)->get();
        return view('admin.order.order_make_ready', compact('order'));
    }

    public function showreadyorder($id)
    {
   /*     $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->where('status', '=', 1)->get();
        $orders = Order::find($id);
        if ($orders->statues == 2) {
            return view('admin.order.show_ready_order', compact('order'));
        } else {
            return redirect()->back()->with('message_fales', 'We Sorry For this');
        }
    }

    public function showmakereadyorder($id)
    {
       /* $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->where('status', '=', 1)->get();
        $orders = Order::find($id);
        if ($orders->statues == 1 || $orders->statues == 7) {
            return view('admin.order.show_make_ready_order', compact('order', 'orders'));
        } else {
            return redirect()->back()->with('message_fales', 'We Sorry For this');
        }
    }

    public function statuesitem($id)
    {
        $newitem = Item::find($id);
        if ($newitem->statues_item_store == 4) {
            $newitem->statues_item_store = 0;
            $newitem->save();
            $order_item = Order_Item::where('item_id', '=', $id)->first();
            $order = Order::find($order_item->order_id);
            $order->total_cost = $order->total_cost - $newitem->price + $newitem->discount;
            $order->count_item_available = $order->count_item_available - 1;
            if ($order->count_item_available != $order->count_item_order) {
                $order->statues = 7;
            } else {
                $order->statues = 1;
            }
            $order->save();
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'not found item';
            $log->data_change = $newitem->id;
            $log->save();
            return redirect()->back()->with('message_fales', 'Done!');
        } elseif ($newitem->statues_item_store == 0) {
            $newitem->statues_item_store = 4;
            $newitem->save();
            $order_item = Order_Item::where('item_id', '=', $id)->first();
            $order = Order::find($order_item->order_id);
            $order->total_cost = $order->total_cost + $newitem->price-$newitem->discount;
            $order->count_item_available = $order->count_item_available + 1;
            if ($order->count_item_available != $order->count_item_order) {
                $order->statues = 7;
            } else {
                $order->statues = 1;
            }
            $order->save();
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'found item';
            $log->data_change = $newitem->id;
            $log->save();
            return redirect()->back()->with('message', 'Done!');
        }

    }

    public function statuesorder($id)
    {
        $order = Order::find($id);

        if ($order->statues == 2) {
            return redirect('/admin/order/order_make_ready')->with('message', 'IS done');
        } else {
            if ($order->delivery == 0 || $order->delivery == 2) {
                $order->statues = 2;
                $order->save();
                $order_item = Order_Item::where('order_id', '=', $id)->get();
                foreach ($order_item as $myorder) {
                    $item = Item::where('id', '=', $myorder->item_id)->first();
                    if ($item != null) {
                        $item->count_item = 0;
                        $item->statues_item_store = 5;
                        $item->save();
                    }
                }
                return redirect('/admin/order/order_make_ready')->with('message', 'done');
            } else {
                if ($order->statues == 2) {
                    return redirect('/admin/order/order_make_ready')->with('message', 'IS done');
                } else {
                    return redirect('/admin/order/' . $id . '/select')->with('message', 'choose company');
                }
            }
        }
    }

    public function selectcompany()
    {
        $city = DB::table("cities")->pluck("name", "id");
        $prices_delivery = null;
        return view('admin.order.prices_delivery_search', compact('prices_delivery', 'city'));
    }

    public function selectcompanypost($id, $id1, $prices)
    {
        $order = Order::with('company_delivery')->where('id', '=', $id)->first();
        if ($order->statues == 2) {
            return redirect('/admin/order/order_make_ready')->with('message', 'IS done');
        } else {
            $order->company_delivery_id = $id1;
            $order->statues = 2;
            $order->prices_delivery = $prices;
            $order->save();
            $company_delivery = Company_Delivery::find($id1);
            $company_delivery->count_order_book = $company_delivery->count_order_book + 1;
            $company_delivery->save();
            $order_item = Order_Item::where('order_id', '=', $id)->get();
            foreach ($order_item as $myorder) {
                $item = Item::where('id', '=', $myorder->item_id)->first();
                if ($item != null) {
                    $item->count_item = 0;
                    $item->statues_item_store = 5;
                    $item->save();
                }
            }
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'select comppany';
            $log->data_change = $order->id;
            $log->save();
            return redirect('/admin/order/' . $order->id . '/order_receipt_company');
        }
    }

    public function orderreceiptcompany($id)
    {
        $order = Order::with('company_delivery')->where('id', '=', $id)->first();
        return view('admin.order.order_receipt_company', compact('order'));
    }

    public function bills()
    {
        $order = Order::where('statues', '=', 10)->get();
        return view('admin.order.order_bills', compact('order'));
    }

    public function orderprint($id)
    {
        $setting = Setting::first();
        $contact = ContactUs::first();
        $order1 = Order::with('company_delivery')->where('id', '=', $id)->first();
        $order2 = Order_Item::with('item')->where('order_id', '=', $id)->get();
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'print bills';
        $log->data_change = $order1->id;
        $log->save();
        $data = ['number_order' => $order1->id,
            'name' => $order1->name,
            'address' => $order1->address,
            'mobile' => $order1->mobile,
            'cost_after_discount' => $order1->cost_after_discount,
            'cost_delivery' => $order1->prices_delivery,
            'total' => $order1->cost_after_discount + $order1->prices_delivery,
            'notes' => $order1->notes,
        ];
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('sharwaonline');
        $pdf->SetTitle('Order');
        $pdf->SetSubject('Order Item');
        $pdf->SetKeywords('Order, PDF');
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);

        $pdf->SetTitle($order1->number_order . "_" . "MA");

        $pdf->SetFont('aealarabiya', '', 11);
        $pdf->SetFontSubsetting(false);
        $pdf->AddPage();

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
// Period of Coverage
        $pdf->SetFontSize(20);
        $pdf->Cell(95, 20, 'Sharwa', '0', 1, 'L', 1);
        $pdf->Image('public/images/setting/' . $setting->image, 150, 5, 35, 35);
        $pdf->SetFontSize(11);
        $pdf->Cell(190, 6, 'Email : ' . $contact->email, '0', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Website : www.sharwaonline.com', '0', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Customer service : ' . $contact->phone, '0', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Delivery Note', '1', 1, 'C', 1);
        $pdf->Cell(190, 6, 'Date :  ' . $order1->created_at, '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Customer Name :' . $data['name'], '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Phone Number :' . $data['mobile'], '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Address :' . $data['address'], '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Comments :' . $data['notes'], '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Order #' . $order1->id, '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Order amount :' . $order1->cost_after_discount, '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Delivery Fees:' . $order1->prices_delivery, '1', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Total Amount :' . number_format($order1->cost_after_discount + $order1->prices_delivery), '1', 1, 'L', 1);
// add a page
        $pdf->AddPage();

        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
// Period of Coverage
        $pdf->SetFontSize(20);
        $pdf->Cell(95, 20, 'Sharwa', '0', 1, 'L', 1);
        $pdf->Image('public/images/setting/' . $setting->image, 150, 5, 35, 35);
        $pdf->SetFontSize(11);
        $pdf->Cell(190, 6, 'Email : ' . $contact->email, '0', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Website : www.sharwaonline.com', '0', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Customer service : ' . $contact->phone, '0', 1, 'L', 1);
        $pdf->Cell(190, 6, 'Item List', '1', 1, 'C', 1);
        $pdf->Cell(190, 6, 'Order Number :  ' . $data['number_order'], '1', 1, 'L', 1);
        $pdf->Cell(25, 6, 'Item', '1', 0, 'C', 1);
        $pdf->Cell(25, 6, 'Item Code', '1', 0, 'C', 1);
        $pdf->Cell(65, 6, "Discription", '1', 0, 'C', 1);
        $pdf->Cell(25, 6, "Price", '1', 0, 'C', 1);
        $pdf->Cell(25, 6, "Discount", '1', 0, 'C', 1);
        $pdf->Cell(25, 6, "Net price", '1', 0, 'C', 1);
        $c = 1;
        $pdf->ln();
        foreach ($order2 as $order) {
            $pdf->Cell(25, 6, $c, '1', 0, 'C', 1);
            $pdf->Cell(25, 6, $order->item->code, '1', 0, 'C', 1);
            $pdf->Cell(65, 6, $order->item->color->name . '-' . $order->item->category_type->name . '-' . $order->item->type->name , '1', 0, 'C', 1);
            $pdf->Cell(25, 6, number_format($order->item->price), '1', 0, 'C', 1);
            $pdf->Cell(25, 6, number_format($order->item->discount), '1', 0, 'C', 1);
            $pdf->Cell(25, 6, number_format($order->item->price-$order->item->discount), '1', 0, 'C', 1);
            $c++;
            $pdf->ln();
        }
        $pdf->Cell(165, 6, 'Total', '1', 0, 'C', 1);
        $pdf->Cell(25, 6, $data['cost_after_discount'], '1', 0, 'C', 1);

        $pdfname = $data['number_order'] . ".pdf";

        return $pdf->Output($pdfname, 'I');

    }

    public function orderreadyindex()
    {
        $order = Order::with('user_create_order', 'company_delivery')->where('statues', '=', 2)
            ->orwhere('statues', '=', 6)->get();
        return view('admin.order.order_ready', compact('order'));
    }

    public function orderinformation($id)
    {
        $order = Order::with('user_create_order', 'company_delivery')->where('id', '=', $id)->get();
        return view('admin.order.order_information', compact('order'));
    }

    public function orderchangeready($id)
    {
        $order = Order::find($id);
        if($order->statues !=1)
        {
        $order->statues = 1;
        $company_delivery = Company_Delivery::find($order->company_delivery_id);
        $company_delivery->count_order_book = $company_delivery->count_order_book - 1;
        $company_delivery->save();
        $order->company_delivery_id = 1;
        $order->save();
        $order_item = Order_Item::where('order_id', '=', $id)->get();
        foreach ($order_item as $myorder) {
            $item = Item::where('id', '=', $myorder->item_id)->first();
            $item->count_item = 1;
            $item->statues_item_store = 4;
            $item->save();
        }
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'order ready';
        $log->data_change = $order->id;
        $log->save();
        return redirect('/admin/order/order_ready')->with('message', 'order not ready');
        }else
        {
            return redirect('/admin/order/order_ready')->with('message_fales', 'order not ready');

        }
    }

    public function orderindex()
    {
        $order = Order::with('user_take', 'company_delivery', 'user_create_order')->get();
        return view('admin.order.order_index', compact('order'));
    }

    public function yourorderindex()
    {
        $order = Order::with('user_take', 'company_delivery', 'user_create_order')
            ->where('user_create_order_id', '=', Auth::User()->id)->get();
        return view('admin.order.your_order_index', compact('order'));
    }

    public function orderout($id)
    {
        $order = Order::find($id);
        if ($order->statues != 3)
        {
            if($order->statues != 10)
            {
                if($order->statues != 4) {
                    $log = new Log();
                    $log->user_id = Auth::user()->id;
                    $log->action_status = 'order out';
                    $log->data_change = $order->id;
                    $log->save();
                    if ($order->delivery == 0) {
                        $order->statues = 3;
                        $order->save();
                        $user = User::find($order->user_create_order_id)->first();
                        $user->total_pay = $user->total_pay + $order->cost_after_discount;
                        $user->save();
                        $order_item=Order_Item::where('order_id',$order->id)->get();
                        foreach($order_item as $orderitem)
                        {
                            $item = Item::find($orderitem->item_id);
                            if($item != null)
                            {
                                $item->statues_item_store=8;
                                $item->update();
                            }
                        }
                        return redirect('/admin/order/order_ready')->with('message', 'done');
                    } elseif ($order->delivery == 2) {
                        $order->statues = 10;
                        $order->time_pay = Carbon::now();
                        $order->save();
                        $order_item=Order_Item::where('order_id',$order->id)->get();
                        foreach($order_item as $orderitem)
                        {
                            $item = Item::find($orderitem->item_id);
                            if($item != null)
                            {
                                $item->statues_item_store=9;
                                $item->update();
                            }
                        }
                        return redirect('/admin/order/order_ready')->with('message', 'done');
                    } elseif ($order->delivery == 1) {
                        $order->statues = 4;
                        $company_delivery = Company_Delivery::find($order->company_delivery_id);
                        $company_delivery->count_order_have = $company_delivery->count_order_have + 1;
                        $company_delivery->save();
                        $order->save();
                        $company = Company_Delivery::find($order->company_delivery_id)->first();
                        $company->total_pay = $company->total_pay + $order->cost_after_discount;
                        $company->save();
                        $order_item=Order_Item::where('order_id',$order->id)->get();
                        foreach($order_item as $orderitem)
                        {
                            $item = Item::find($orderitem->item_id);
                            if($item != null)
                            {
                                $item->statues_item_store=7;
                                $item->update();
                            }
                        }
                        return redirect('/admin/order/order_ready')->with('message', 'done');
                    }
                }else {
                    return redirect('/admin/order/order_ready')->with('message_fales', 'done');
                }
            }else {
                return redirect('/admin/order/order_ready')->with('message_fales', 'done');
            }
        } else {
            return redirect('/admin/order/order_ready')->with('message_fales', 'done');
        }
    }

    public function ordersearchget()
    {
        $order_company = Order::where('statues', '=', 4)->get();
        $order_user = Order::where('statues', '=', 3)->get();
        $names_order = [];
        $company_order = [];
        foreach ($order_company as $orders) {
            array_push($company_order, $orders->company_delivery_id);
        }
        foreach ($order_user as $orders) {
            array_push($names_order, $orders->user_create_order_id);
        }
        $names_order = array_unique($names_order);
        $company_order = array_unique($company_order);
        $company_delivery = DB::table("company_deliveries")->pluck("name", "id");
        $user = DB::table("users")->pluck("username", "id");
        return view('admin.order.order_search', compact('company_delivery', 'user', 'names_order', 'company_order'));
    }

    public function ordersearchpost(Request $request)
    {
        if ($request->input('id') == null) {
            if ($request->input('mobile') == null) {
                if ($request->input('user_create_id') == null) {
                    if ($request->input('company_delivery_id') == null) {
                        return redirect()->back()->with('message_fales', 'not found');
                    } else {
                        $order = Order::with('company_delivery', 'user_create_order', 'user_take')
                            ->where('company_delivery_id', '=', $request->input('company_delivery_id'))
                            ->where('statues', '=', 4)->get();
                        return view('admin.order.order_search_index', compact('order'));
                    }
                } else {
                    $order = Order::with('company_delivery', 'user_create_order', 'user_take')
                        ->where('user_create_order_id', '=', $request->input('user_create_id'))
                        ->where('statues', '=', 3)->get();
                    return view('admin.order.order_search_index', compact('order'));
                }
            } else {
                $order = Order::with('company_delivery', 'user_create_order', 'user_take')
                    ->where('mobile', '=', $request->input('mobile'))
                    ->where('statues', '=', 2)->get();
                return view('admin.order.order_search_index', compact('order'));
            }
        } else {
            $order = Order::with('company_delivery', 'user_create_order', 'user_take')
                ->where('id', '=', $request->input('id'))
                ->where('statues', '=', 2)->get();
            return view('admin.order.order_search_index', compact('order'));
        }
    }

    public function orderpay($id)
    {
        $order = Order::find($id);
        if ($order->statues != 10) {
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'order pay';
            $log->data_change = $order->id;
            $log->save();
            if ($order->delivery == 0) {
                $order->statues = 10;
                $order->time_pay = Carbon::now();
                $order->save();
                $user = User::find($order->user_create_order_id);
                $account = new Account_User();
                $account->user_id = $user->id;
                $account->total_after = $user->total_pay;
                $account->total_before = $account->total_after + $order->cost_after_discount;
                $account->pay = $order->cost_after_discount;
                $account->take = 0;
                $account->save();
                $user->total_pay = $user->total_pay - $order->cost_after_discount;
                $user->save();

            } elseif ($order->delivery == 1) {
                $order->statues = 10;
                $order->time_pay = Carbon::now();
                $order->save();
                $company = Company_Delivery::find($order->company_delivery_id)->first();
                $account = new Account_Company();
                $account->company_id = $company->id;
                $account->total_after = $company->total_pay;
                $account->total_before = $account->total_after + $order->cost_after_discount;
                $account->pay = $order->cost_after_discount;
                $account->take = 0;
                $account->save();
                $company->total_pay = $company->total_pay - $order->cost_after_discount;
                $company->save();
            } elseif ($order->delivery == 2) {
                $order->statues = 6;
                $order->time_pay = Carbon::now();
                $order->save();
            }
            $order_item=Order_Item::where('order_id',$order->id)->get();
            foreach($order_item as $orderitem)
            {
                $item = Item::find($orderitem->item_id);
                if($item != null)
                {
                    $item->statues_item_store=9;
                    $item->update();
                }
            }
            return redirect()->back()->with('message', 'done');
        } else {
            return redirect('/admin/order/pay')->with('message_fales', 'IS done');
        }

    }

    public function indexpay()
    {
        $order = Order::where('statues', '=', 3)->orwhere('statues', '=', 4)->orwhere('statues', '=', 2)->where('delivery', '=', 2)->get();
        return view('admin.order.index_pay', compact('order'));
    }

    public function indexorderwithyou()
    {
        $order = Order::where('statues', '=', 3)->where('user_create_order_id', '=', Auth::user()->id)->get();
        return view('admin.order.with_order_index', compact('order'));
    }

    public function showorderwith($id)
    {
/*        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->where('status', '=', 1)->get();
        return view('admin.order.show_with_order', compact('order'));
    }

    public function showyourorder($id)
    {
 /*       $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->where('status', '=', 1)->get();
        return view('admin.order.show_your_order', compact('order'));
    }

    public function editorder($id)
    {
   /*     $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->get();
        return view('admin.order.edit_order', compact('order'));
    }

    public function editorderpost($id, $id1)
    {
        $order = Order::find($id);
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'order edit';
        $log->data_change = $order->id;
        $log->save();
        $order_item = Order_Item::where('item_id', '=', $id1)->get();
        foreach ($order_item as $x) {
            $x->delete();
        }
        $item = Item::find($id1);

                $order->total_cost = $order->total_cost -$item->price + $item->discount;

        $order->count_item_order = $order->count_item_order - 1;
        $order->count_item_available = $order->count_item_available - 1;
        $order->save();
        $user = User::find($order->user_create_order_id)->first();
            $user->total_pay = $user->total_pay - $item->price + $item->discount;
        $user->save();
        if ($order->statues == 1) {
            $item->statues_item_store = 3;
            $item->count_item = 1;
            $item->statues = 1;
            $item->save();
        } elseif ($order->statues == 2) {
            $item->statues_item_store = 2;
            $item->count_item = 1;
            $item->statues = 0;
            $item->save();
            $order->statues = 8;
            $order->save();
        }
        if ($order->count_item_order == 0) {
            $order->delete();
            return redirect('/admin');
        } else {
            return redirect()->back();
        }
    }

    public function cansalorder($id)
    {
        $order = Order::find($id);
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'order cansal';
        $log->data_change = $order->id;
        $log->save();
        $user = User::find($order->user_create_order_id)->first();
        $user->total_pay = $user->total_pay - $order->cost_after_discount;
        $user->save();
        $order_item = Order_Item::with('item')->where('order_id', '=', $id)->get();
        foreach ($order_item as $items) {
            $item = Item::find($items->item->id);
            if ($order->statues == 1) {
                $item->statues_item_store = 3;
                $item->count_item = 1;
                $item->statues = 1;
                $item->save();
                $order->cancellation_cost = $order->cancellation_cost + $item->price -$item->discount;
                $order->count_item_order = $order->count_item_order - 1;
                $order->save();
            } elseif ($order->statues == 2) {
                $item->statues_item_store = 2;
                $item->count_item = 1;
                $item->statues = 0;
                $item->save();
                $order->cancellation_cost = $order->cancellation_cost + $item->price-$item->discount;
                $order->count_item_order = $order->count_item_order - 1;
                $order->save();
            }
            $items->status = 0;
            $items->save();
        }
        $order->statues = 9;
        $order->time_cancellation = Carbon::now();
        $order->save();
        return redirect('/admin');
    }

    public function orderchangeget()
    {
        $order = Order::with('user_create_order', 'company_delivery')->where('statues', '=', 8)->get();
        return view('admin.order.order_change', compact('order'));
    }

    public function showchangeorder($id)
    {
        /*$order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->where('status', '=', 1)->get();
        return view('admin.order.show_change_order', compact('order'));
    }

    public function ordersearchdiscardedget()
    {
        return view('admin.order.order_search_discarded');
    }

    public function ordersearchdiscardedpost(Request $request)
    {
        if ($request->input('id') == null) {
            if ($request->input('mobile') == null) {
                return redirect()->back()->with('message_fales', 'not found or pay time after 14 day');
            } else {
                $order = Order::with('company_delivery', 'user_create_order', 'user_take')
                    ->where('mobile', '=', $request->input('mobile'))
                    ->where('statues', '=', 10)
                    ->where('time_pay', '>=', Carbon::now()->subDays(14))->get();
                if (count($order) == 0) {
                    return redirect()->back()->with('message_fales', 'not found or pay time after 14 day');
                } else {
                    return view('admin.order.order_search_discarded_index', compact('order'));
                }
            }
        } else {
            $order = Order::with('company_delivery', 'user_create_order', 'user_take')
                ->where('id', '=', $request->input('id'))
                ->where('statues', '=', 10)
                ->where('time_pay', '>=', Carbon::now()->subDays(14))->get();
            if (count($order) == 0) {
                return redirect()->back()->with('message_fales', 'not found or pay time after 14 day');
            } else {
                return view('admin.order.order_search_discarded_index', compact('order'));
            }
        }
    }

    public function orderdiscarded($id)
    {
        $order = Order::find($id);
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'order discarded';
        $log->data_change = $order->id;
        $log->save();
        $order->statues = 11;
        $order->save();
        $order_item = Order_Item::with('item')->where('order_id', '=', $id)->get();
        foreach ($order_item as $items) {
            $item = Item::find($items->item->id);
            $item->statues_item_store = 3;
            $item->count_item = 1;
            $item->statues = 0;
            $item->save();
            $items->status = 0;
            $items->save();
            $order->discarded_cost = $order->discarded_cost + $item->price-$item->discount;
            $order->count_item_order = $order->count_item_order - 1;
            $order->time_discarded = Carbon::now();
            $order->save();
        }
        if ($order->delivery == 3) {
            $user = User::find($order->user_create_order_id)->first();
            $account = new Account_User();
            $account->user_id = $user->id;
            $account->total_after = $user->total_pay;
            $account->total_before = $account->total_after - $order->total_cost;
            $account->pay = 0;
            $account->take = $order->total_cost;
            $account->save();
        }
        return redirect('/admin/order/order_search_discarded')->with('message', 'order is discarded');
    }

public function discount(Request $request,$id)
{
    $item=Item::find($id);
    if($item->discount != $request->discount )
    {
        if($item->price != $request->discount && $item->price  > $request->discount)
        {
        $item->discount = $request->discount;
        $item->discount_user_id = Auth::user()->id;
        $item->update();
        }
        else
        {
            return redirect()->back()->with('message_fales','Discount Can\'t Done');
        }
    }
    return redirect()->back()->with('message','Discount Done');
}
}

?>