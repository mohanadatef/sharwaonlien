<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Order\Finish_Request;
use App\Models\Account_User;
use App\Models\Order;
use App\Models\Order_Item;
use App\User;
use Illuminate\Http\Request;
use App\Models\Cart_Item;
use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function searchitemget()
    {
        $cheack_cart=Cart_Item::where('created_at','<=',Carbon::now()->modify('-3 hours'))->get();
        if($cheack_cart != null )
        {
            foreach ($cheack_cart as $cheackcart)
            {
                $cart = Cart_Item::find($cheackcart->id);
                $cart->delete();
                $newitem = Item::find($cheackcart->item_id);
                $newitem->statues=1;
                $newitem->save();
            }
        }
        $brand = DB::table("brandes")->pluck("name", "id");
        $category_type = DB::table("category_types")->pluck("name", "id");
        $type = DB::table("types")->pluck("name", "id");
        $size = DB::table("sizes")->pluck("name", "id");
        $color = DB::table("colores")->pluck("name", "id");
        //$gender = DB::table("genderes")->pluck("name", "id");
        return view('admin.cart_item.make_order', compact('brand', 'category_type', 'type', 'size', 'color'));
/*        return view('admin.cart_item.make_order', compact('brand', 'category_type', 'type', 'size', 'color', 'gender'));*/
    }

    public function searchitempost(Request $request)
    {
        $cheack_cart=Cart_Item::where('created_at','<=',Carbon::now()->modify('-3 hours'))->get();
        if($cheack_cart != null )
        {
            foreach ($cheack_cart as $cheackcart)
            {
                $cart = Cart_Item::find($cheackcart->id);
                $cart->delete();
                $newitem = Item::find($cheackcart->item_id);
                $newitem->statues=1;
                $newitem->save();
            }
        }
        if($request->input('id')==null)
        {
        /*if ($request->input('gender_id') == 0) {
            $gender_id = 0;
            $gender = '>';
        } else {
            $gender_id = $request->input('gender_id');
            $gender = '=';
        }*/
        if ($request->input('category_type_id') == 0) {
            $category_type_id = 0;
            $category_type = '>';
        } else {
            $category_type_id = $request->input('category_type_id');
            $category_type = '=';
        }
        if ($request->input('type_id') == 0) {
            $type_id = 0;
            $type = '>';
        } else {
            $type_id = $request->input('type_id');
            $type = '=';
        }
        if ($request->input('brand_id') == 0) {
            $brand_id = 0;
            $brand = '>';
        } else {
            $brand_id = $request->input('brand_id');
            $brand = '=';
        }
        if ($request->input('size_id') == 0) {
            $size_id = 0;
            $size = '>';
        } else {
            $size_id = $request->input('size_id');
            $size = '=';
        }
        if ($request->input('color_id') == 0) {
            $color_id = 0;
            $color = '>';
        } else {
            $color_id = $request->input('color_id');
            $color = '=';
        }
        //where('gender_id', $gender, $gender_id)->
        $item = Item::where('category_type_id', $category_type, $category_type_id)
            ->where('type_id', $type, $type_id)
            ->where('brand_id', $brand, $brand_id)
            ->where('size_id', $size, $size_id)
            ->where('color_id', $color, $color_id)
            ->where('statues_item_store', '=', 3)
            ->where('statues', '=', 1)
            ->where('statues_item_store', '=', 3)->get();
        $count_item = count($item);

        if ($item == null) {
            return redirect()->back()->with('message_fales', 'not found');
        } else {
                return view('admin.cart_item.make_order_index', compact('item', 'count_item'));
        }
        }
        else
            {
                $item = Item::where('id','=',$request->input('id'))
                    ->where('statues', '=', 1)
                    ->where('statues_item_store', '=', 3)->get();
                $count_item = count($item);
                if ($item == null) {
                    return redirect()->back()->with('message_fales', 'not found');
                } else {
                    return view('admin.cart_item.make_order_index', compact('item', 'count_item'));
                }
        }
    }

    public function selectitem($id)
    {
        $cheack_cart=Cart_Item::where('created_at','<=',Carbon::now()->modify('-3 hours'))->get();
        if($cheack_cart != null )
        {
            foreach ($cheack_cart as $cheackcart)
            {
                $cart = Cart_Item::find($cheackcart->id);
                $cart->delete();
                $newitem = Item::find($cheackcart->item_id);
                $newitem->statues=1;
                $newitem->save();
            }
        }
        $newitem = Item::find($id);
        if ($newitem->statues == 1) {
            $newitem->statues = 0;
            $newitem->save();
            $cart_item = new Cart_Item();
            $cart_item->user_select_id = Auth::user()->id;
            $cart_item->item_id = $id;
            $cart_item->save();
            return redirect()->back()->with('message', 'select item done');
        }
        else {
            return redirect()->back()->with('message_fales', 'We Sorry This Item Not Availabel');
        }
    }

    public function cancellationselectitem($id)
    {
        $cart_item = Cart_Item::find($id);
        $newitem = Item::find($cart_item->item_id);
        $newitem->statues=1;
        $newitem->save();
        $cart_item->delete();
        return redirect()->back()->with('message', 'select item Cancellation');
    }

    public function finishorder(Request $request,$id)
    {
        $order = new Order();
        if($request->name != null)
        {
            $order->name=$request->name;
        }
        else
        {
            $order->name=' ';
        }
        if($request->address != null)
        {
            $order->address=$request->address;
        }
        else
        {
            $order->address=' ';
        }
        $order->user_create_order_id=Auth::user()->id;
        if($request->notes != null)
        {
            $order->notes=$request->notes;
        }
        else
        {
        $order->notes=' ';
        }
        if($request->mobile != null)
        {
            $order->mobile=$request->mobile;
        }
        else
        {
            $order->mobile=' ';
        }
        $order->delivery=0;
        $order->prices_delivery=0;
        $order->company_delivery_id=1;
        $order->user_take_id=Auth::user()->id;
        $order->client=0;
        $order->total_cost=0;
        $order->time_pay=Carbon::now();
        $order->cost_after_discount=0;
        $order->statues=1;
        $order->count_item_order=0;
        $order->count_item_available=0;
        $order->time_pay=Carbon::now();
        $order->cancellation=0;
        $order->cancellation_cost=0;
        $order->time_cancellation=Carbon::now();
        $order->discarded=0;
        $order->discarded_cost=0;
        $order->time_discarded=Carbon::now();
        $order->save();
        $id_order= $order->id;
        $cart_item = Cart_Item::where('user_select_id', '=',$id)->get();
        foreach ($cart_item as $my_cart_item)
        {
        $order_item = new Order_Item();
            $order_item->item_id=$my_cart_item->item_id;
            $order_item->status=1;
            $order_item->order_id=$id_order;
            $order_item->save();
            $newitem = Item::find($order_item->item_id);
            $newitem->statues_item_store=4;
            $newitem->statues=0;
            $newitem->update();
            $neworder = Order::find($id_order);
            $neworder->total_cost= $neworder->total_cost + $newitem->price ;
            $neworder->cost_after_discount=$neworder->cost_after_discount+ $newitem->price-$newitem->discount ;
            $neworder->count_item_order=$neworder->count_item_order +1 ;
            $neworder->count_item_available=$neworder->count_item_available +1 ;
            $neworder->update();
            $my_cart_item->delete();
        }
        $order = Order::find($id_order);
        return view('admin.order.order',compact('order'));
    }

    public function indexcartitem()
    {
        /*$cart_item = Cart_Item::with('user','item.brand','item.type','item.size','item.color','item.gender')*/
        $cart_item = Cart_Item::with('user','item.brand','item.type','item.size','item.color')
            ->where('user_select_id', '=', Auth::user()->id)->get();
        return view('admin.cart_item.cart_item_index', compact('cart_item'));
    }

    public function finishorderdirect($id)
    {
        $order = new Order();
            $order->name='direct';
            $order->address='direct';
        $order->user_create_order_id=Auth::user()->id;
            $order->notes='direct';
            $order->mobile='010123456789';
        $order->delivery=0;
        $order->prices_delivery=0;
        $order->company_delivery_id=1;
        $order->user_take_id=Auth::user()->id;
        $order->client=0;
        $order->total_cost=0;
        $order->time_pay=Carbon::now();
        $order->cost_after_discount=0;
        $order->statues=3;
        $order->count_item_order=0;
        $order->count_item_available=0;
        $order->time_pay=Carbon::now();
        $order->cancellation=0;
        $order->cancellation_cost=0;
        $order->time_cancellation=Carbon::now();
        $order->discarded=0;
        $order->discarded_cost=0;
        $order->time_discarded=Carbon::now();
        $order->save();
        $id_order= $order->id;
        $cart_item = Cart_Item::where('user_select_id', '=',$id)->get();
        foreach ($cart_item as $my_cart_item)
        {
            $order_item = new Order_Item();
            $order_item->item_id=$my_cart_item->item_id;
            $order_item->status=1;
            $newitem = Item::find($order_item->item_id);
            $newitem->statues_item_store=8;
            $newitem->statues=0;
            $neworder = Order::find($id_order);
            $neworder->total_cost= $neworder->total_cost + $newitem->price ;
                $neworder->cost_after_discount=$neworder->cost_after_discount + $newitem->price - $newitem->discount ;

            $neworder->count_item_order=$neworder->count_item_order +1 ;
            $neworder->count_item_available=$neworder->count_item_available +1 ;
            $newitem->save();
            $neworder->save();
            $order_item->order_id=$neworder->id;
            $order_item->save();
            $my_cart_item->delete();
        }
        $user = User::find(Auth::user()->id);
        $user->total_pay=$user->total_pay+$neworder->cost_after_discount;
        $user->update();
        return redirect('admin')->with('message','Order Done');
    }
}

?>