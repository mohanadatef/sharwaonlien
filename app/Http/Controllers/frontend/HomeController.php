<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\Finish_Request;
use App\Http\Requests\frontend\ItemRequest;
use App\Http\Requests\frontend\ProfileRequest;
use App\Models\CategoryType;
use App\Models\Color;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\Size;
use App\Models\Type;
use App\User;
use App\Http\Requests\frontend\Customer_Request;
use App\Role_user;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\CallUsCreateRequest;
use App\Http\Requests\frontend\Job_Request;
use App\Models\AboutUs;
use App\Models\Call_Us;
use App\Models\Customer;
use App\Models\Home_Slider;
use App\Models\Item;
use App\Models\Job;
use App\Models\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $home_slider = Home_Slider::all();
        $item = Item::where('statues_item_store', 3)->where('statues',  1)->take(5)->get();
            $item1 = Item::where('statues_item_store', 3)->where('statues',  1)->first();
        $myslider = Home_Slider::first();
        $check = 0;
        return view('frontend.home', compact('home_slider', 'myslider', 'item', 'item1', 'check'));
    }
    public function about_us()
    {
        $about_us = AboutUs::first();
        return view('frontend.about_us', compact('about_us'));
    }
    public function item1(ItemRequest $request)
    {
        $name = $request->name;
        return redirect('/item/' . $name);
    }
    public function discount_item()
    {
        $item = Item::where('statues', '=', 1)->where('statues_item_store', '=', 3)->where('discount','!=',0)->paginate(5);
        Cookie::queue('check', 0, 24 * 60);
        return view('frontend.item', compact('item'));
    }
    public function item($name)
    {
        $brand = DB::table("brandes")->where('name', $name)->pluck("id", "id");
        $item_brand = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->wherein('brand_id', $brand)->pluck("id", "id");
        $size = DB::table("sizes")->where('name', $name)->pluck("id", "id");
        $item_size = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->wherein('size_id', $size)->pluck("id", "id");
        $color = DB::table("colores")->where('name', $name)->pluck("id", "id");
        $item_color = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->wherein('color_id', $color)->pluck("id", "id");
        $type = DB::table("types")->where('name', $name)->pluck("id", "id");
        $item_type = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->wherein('type_id', $type)->pluck("id", "id");
        $category_type = DB::table("category_types")->where('name', $name)->pluck("id", "id");
        $item_category_type = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->wherein('category_type_id', $category_type)->pluck("id", "id");
        $data_item = array_merge($item_brand->toArray(), $item_size->toArray(), $item_type->toArray(), $item_color->toArray(), $item_category_type->toArray());
        $item = Item::wherein('id', $data_item)->paginate(5);
        Cookie::queue('check', 0, 24 * 60);
        return view('frontend.item', compact('item'));
    }
    public function contact_us()
    {
        $check = 0;
        return view('frontend.contact_us', compact('check'));
    }
    public function call_us(CallUsCreateRequest $request)
    {
        $newcallus = new Call_Us();
        $newcallus->create($request->all());
        $check = 1;
        return view('frontend.contact_us', compact('check'));

    }
    public function job()
    {
        $job = Job::orderby('order')->get();
        return view('frontend.job', compact('job'));
    }
    public function requestjob(job_Request $request)
    {
        $newjobrequest = new JobRequest();
        $newjobrequest->first_name = $request->input('first_name');
        $newjobrequest->last_name = $request->input('last_name');
        $newjobrequest->gender = $request->input('gender');
        $newjobrequest->email = $request->input('email');
        $newjobrequest->mobile = $request->input('mobile');
        $newjobrequest->birth_date = $request->input('day') . '-' . $request->input('month') . '-' . $request->input('year');
        if ($request->input('uOhter') != null) {
            $newjobrequest->university = $request->input('uOhter');
        } elseif ($request->input('university') != null) {
            $newjobrequest->university = $request->input('university');
        } else {
            $newjobrequest->university = "           ";
        }
        if ($request->input('fOhter') != null) {
            $newjobrequest->faculty = $request->input('fOhter');
        } elseif ($request->input('faculty') != null) {
            $newjobrequest->faculty = $request->input('faculty');
        } else {
            $newjobrequest->faculty = "           ";
        }
        $newjobrequest->year = $request->input('year');
        $newjobrequest->grade = $request->input('grade');
        $newjobrequest->message = $request->input('message');
        $newjobrequest->job_id = $request->input('job_id');
        $filename = time() . '.' . Request()->resume->getClientOriginalExtension();
        Request()->resume->move(public_path('files/resume'), $filename);
        $newjobrequest->resume = ($filename);
        $newjobrequest->save();
        return redirect('/job')->with('message', 'your order Done ,Good luck');
    }
    public function sign_up()
    {
        return view('frontend.sign_up');
    }
    public function cart()
    {
        $prod = unserialize(Cookie::get('cart'));
        $total = 0;
        if ($prod != null) {
            $item = Item::wherein('id', $prod)->get();
            if ($item != null) {
                foreach ($item as $myitem) {
                    $total = $total + $myitem->price;
                }
            } else {
                $item[] = null;
            }
        } else {
            $item = null;
        }
        return view('frontend.cart', compact('item', 'total'));
    }
    public function register()
    {
        $check = 0;
        return view('frontend.register', compact('check'));
    }
    public function create(Customer_Request $request)
    {
        $newuser = new User();
        $newuser->username = $request->input('username');
        if($request->input('email') == null)
        {
            $newuser->email='defult'.time().'@defult.com';
        }else{$newuser->email = $request->input('email');}
        $newuser->password = Hash::make($request->input('password'));
        $newuser->statues = 1;
        $newuser->kind = 2;
        $newuser->total_pay = 0;
        $newuser->save();
        $user = User::where('email', $request->input('email'))->first();
        $newroleuser = new Role_user();
        $newroleuser->user_id = $user->id;
        $newroleuser->role_id = 6;
        $newroleuser->save();
        $newcustomer = new Customer();
        $newcustomer->user_id = $user->id;
        $newcustomer->mobile = $request->input('mobile');
        $newcustomer->address = $request->input('address');
        $newcustomer->save();
        $check = 1;
        return view('frontend.register', compact('check'));
    }
    public function profile()
    {
        $customer = Customer::where('user_id', Auth::User()->id)->first();
        $user = User::find(Auth::User()->id);
        return view('frontend.profile', compact('customer', 'user'));
    }
    public function profileedit(ProfileRequest $request)
    {
        $customer = Customer::where('user_id', Auth::User()->id)->first();
        $customer->update($request->all());
        $user = User::find(Auth::User()->id);
        $user->update($request->all());
        return redirect('/');
    }
    public function your_history()
    {
        $order = Order::where('user_create_order_id', Auth::User()->id)->get();

        return view('frontend.your_history', compact('order'));
    }
    public function canasel(ItemRequest $request)
    {
        $data[] = $request->canasel_item;
        $prod = unserialize(Cookie::get('cart'));
        $prod = array_diff($prod, $data);
        Cookie::queue('cart', serialize($prod), 24 * 60);
        return redirect()->back()->with('message', 'Canasel Is Done!');
    }
    public function finish()
    {
        if(Auth::User() == true)
        {
        $user = User::find(Auth::User()->id);
        $customer = Customer::where('user_id', $user->id)->first();
        return view('frontend.finish', compact('user', 'customer'));
        }
        else
        {
            return redirect('/sign_up')->with('message_fales','we sorry but you need to login first');
        }
    }
    public function finishcreate(Finish_Request $request)
    {

            $prod = unserialize(Cookie::get('cart'));
            $item = Item::wherein('id',$prod)->get();
            foreach ($item as $myitem)
            {
                if($myitem->statues == 1 && $myitem->statues_item_store == 3)
                {
                    $data[]=$myitem->id;
                    $prod = array_merge($prod, $data);
                }
                else
                {
                    $data[]=$myitem->id;
                    $prod = array_diff($prod, $data);
                    Cookie::queue('cart', serialize($prod), 24 * 60);
                }
            }
        $item = Item::wherein('id',$prod)->get();
            if($item != null)
            {
        $total = 0;
        foreach ($item as $myitem) {
            $total = $total + $myitem->price;
        }
        $order = new Order();
        $order->name = $request->name;
        $order->address = $request->address.' - Apartment : '.$request->Apartment.' - building : '.$request->building;
        $order->user_create_order_id = Auth::user()->id;
        if ($request->notes != null) {
            $order->notes = $request->notes;
        } else {
            $order->notes = ' ';
        }
        $order->mobile = $request->mobile;
        $order->delivery = 1;
        $order->prices_delivery = 0;
        $order->company_delivery_id = 1;
        $order->user_take_id = Auth::user()->id;
        $order->client = 0;
        $order->total_cost = $total;
        $order->time_pay = Carbon::now();
        $order->cost_after_discount = $total;
        $order->statues = 1;
        $order->count_item_order = count($item);
        $order->count_item_available = count($item);
        $order->cancellation = 0;
        $order->cancellation_cost = 0;
        $order->time_cancellation = Carbon::now();
        $order->discarded = 0;
        $order->discarded_cost = 0;
        $order->time_discarded = Carbon::now();
        $order->save();
        foreach ($item as $myitem) {
            $order_item = new Order_Item();
            $order_item->item_id = $myitem->id;
            $order_item->status = 1;
            $newitem = Item::find($order_item->item_id);
            $newitem->statues_item_store = 4;
            $newitem->statues = 0;
            $newitem->save();
            $neworder = Order::where('mobile', $request->input('mobile'))->get()->last();
            $order_item->order_id = $neworder->id;
            $order_item->save();
            $neworder1 = Order::find($order_item->order_id);
            $neworder1->statues = 1;
            $neworder1->save();
        }
                $prod = unserialize(Cookie::get('cart'));
                $item = Item::wherein('id',$prod)->get();
                foreach ($item as $myitem)
                {
                    if($myitem->statues == 1 && $myitem->statues_item_store == 3)
                    {
                        $data[]=$myitem->id;
                        $prod = array_merge($prod, $data);
                    }
                    else
                    {
                        $data[]=$myitem->id;
                        $prod = array_diff($prod, $data);
                        Cookie::queue('cart', serialize($prod), 24 * 60);
                    }
                }

        $check = 1;
        return redirect('/')->with(compact('check'));
            }
            else{
                return redirect('/')->with('message_fales','we sorry but this item is sale before');
            }
    }
    public function set_cart(ItemRequest $request)
    {

            $item = Item::find($request->select_item);
            if ($item->statues == 1 && $item->statues_item_store == 3) {
                if(Cookie::get('cart') != null) {
                    $prod = unserialize(Cookie::get('cart'));
                    $item = Item::wherein('id', $prod)->get();
                    foreach ($item as $myitem) {
                        if ($myitem->statues == 1 && $myitem->statues_item_store == 3) {
                            $data[] = $myitem->id;
                            $prod = array_merge($prod, $data);
                        } else {
                            $data[] = $myitem->id;
                            $prod = array_diff($prod, $data);
                            Cookie::queue('cart', serialize($prod), 24 * 60);
                        }
                    }

                      $data[] = $request->select_item;
                    $prod = array_merge($prod, $data);
                    $prod=array_unique($prod);
                }
                else{
                    $prod[] = $request->select_item;
                }
                Cookie::queue('check', 1, 24 * 60);
                return redirect()->back()->withCookie('cart', serialize($prod), 24 * 60)->with('message', 'Add to You Cart done') ;
            } else {
                Cookie::queue('check', 0, 24 * 60);
                return redirect()->back()->with('message_fales', 'we sorry but this item is sale before');
            }
    }
    public function filter(Request $request)
    {
        if($request->size != '0')
        {
            $item_size = DB::table('items')->where('size_id',$request->size)->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        else
        {
            $item_size = DB::table('items')->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        if($request->color != '0')
        {
            $item_color = DB::table('items')->where('color_id',$request->color)->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        else
        {
            $item_color = DB::table('items')->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        if($request->type != '0')
        {
            $item_type = DB::table('items')->where('type_id',$request->type)->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        else
        {
            $item_type = DB::table('items')->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        if($request->category_type != '0')
        {
            $item_category_type = DB::table('items')->where('category_type_id',$request->category_type)->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        else
        {
            $item_category_type = DB::table('items')->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck('id','id');
        }
        $items=array_merge($item_size->toArray(),$item_category_type->toArray());
        $item = array_unique( array_diff_assoc( $items, array_unique( $items ) ) );
        $items=array_merge($item,$item_type->toArray());
        $item = array_unique( array_diff_assoc( $items, array_unique( $items ) ) );
        $items=array_merge($item,$item_color->toArray());
        $item = array_unique( array_diff_assoc( $items, array_unique( $items ) ) );
       // $item=array_unique($items);
        $items=DB::table('items')->wherein('id', $item)->get();
        foreach ($items as $item)
        {
            $size_name=Size::find($item->size_id);
            $item->size_id = $size_name->name;
            $color_name=Color::find($item->color_id);
            $item->color_id = $color_name->name;
            $type_name=Type::find($item->type_id);
            $item->type_id = $type_name->name;
            $category_type_name=CategoryType::find($item->category_type_id);
            $item->category_type_id = $category_type_name->name;
        }
        return response()->json($items);
    }
}
