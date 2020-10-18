<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Item\ItemCostEditRequest;
use App\Http\Requests\admin\Item\ItemCreateRequest;
use App\Http\Requests\admin\Item\ItemEditRequest;
use App\Http\Requests\admin\Item\ItemSearchRequest;
use App\Models\Bag;
use App\Models\Brand;
use App\Models\Item;
use App\Models\Location;
use App\Models\Log;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexitem()
    {
        $item = Item::orderby('created_at','desc')->paginate(10);
        return view('admin.item.item_index', compact('item'));
    }

    public function createitemget()
    {
        $brand = DB::table("brandes")->pluck("name", "id");
        $category_type = DB::table("category_types")->pluck("name", "id");
        $type = DB::table("types")->pluck("name", "id");
        $bag = DB::table("bags")->pluck("name", "id");
        $size = DB::table("sizes")->pluck("name", "id");
        $color = DB::table("colores")->pluck("name", "id");
        return view('admin.item.item_create', compact('brand', 'category_type', 'type', 'bag', 'size', 'color'));
    }

    public function createitempost(ItemCreateRequest $request)
    {
        $item = Item::all()->last();
        if ($item == null) {
            $id = 1;
        } else {
            $id = $item->id + 1;
        }
        $newitem = new Item();
        $newitem->bag_id = $request->input('bag_id');
        $newitem->brand_id = $request->input('brand_id');
        $newitem->category_type_id = $request->input('category_type_id');
        $newitem->type_id = $request->input('type_id');
        $newitem->size_id = $request->input('size_id');
        $newitem->color_id = $request->input('color_id');
        $newitem->location_id = 1;
        if($request->discount !=null)
        {
        $newitem->discount = $request->discount;
        }
        else
        {
            $newitem->discount =0;
        }
        $location = Location::find(1);
        $location->count_item = $location->count_item + 1;
        $location->save();
        $newitem->cost = $request->cost;
        $newitem->price = $request->price;
        $newitem->order = 1000;
        $newitem->statues = 0;
        $newitem->count_item = 1;
        if($request->price >0 && $request->price !=0)
        {
            $newitem->statues_item_store = 2;
        }
        else{
        $newitem->statues_item_store = 1;
        }
        if ($request->input('height_item') == null) {
            $newitem->height_item = 0;
        } else {
            $newitem->height_item = $request->input('height_item');
        }
        if ($request->input('width_item') == null) {
            $newitem->width_item = 0;
        } else {
            $newitem->width_item = $request->input('width_item');
        }
        $newitem->user_create_id = Auth::user()->id;
        $newitem->discount_user_id = Auth::user()->id;
        $bag = Bag::find($newitem->bag_id);
        $newitem->supplier_id = $bag->supplier_id;
        $x = $bag->count_item;
        $bag->count_item = $x + 1;
        $brand = Brand::find($newitem->brand_id);
        $size = Size::find($newitem->size_id);
        $newitem->code = $brand->code . '-' . $size->code . '-' . $id;
        $newitem->weight = $request->input('weight');
        if ($request->image_main != null) {
            $imageName = $newitem->code . '.' . Request()->image_main->getClientOriginalExtension();
            Request()->image_main->move(public_path('images/item'), $imageName);
            $newitem->image_main = ($imageName);
        } else {
            $newitem->image_main = $newitem->code;
        }
        $newitem->save();
        $bag->save();
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'create item';
        $log->data_change = $newitem->code;
        $log->save();
        /*       $search_item = Item::where('gender_id', '=', $request->input('gender_id'))*/
        $search_item = Item::where('category_type_id', '=', $request->input('category_type_id'))
            ->where('type_id', '=', $request->input('type_id'))
            ->where('brand_id', '=', $request->input('brand_id'))
            ->where('size_id', '=', $request->input('size_id'))
            ->where('color_id', '=', $request->input('color_id'))->get();
        if ($search_item == null) {
            return redirect('admin/item')->with('message', 'Add item Is Done!');
        } else {
            return redirect('admin/item')->with('message_error', 'Add item Is Done! but you have same item before');
        }
    }

    public function edititemget($id)
    {
        $item = Item::find($id);
        $brand = DB::table("brandes")->pluck("name", "id");
        $category_type = DB::table("category_types")->pluck("name", "id");
        $type = DB::table("types")->pluck("name", "id");
        $bag = DB::table("bags")->pluck("name", "id");
        $size = DB::table("sizes")->pluck("name", "id");
        $color = DB::table("colores")->pluck("name", "id");
        $minimum_price=number_format((($item->bag->cost_profit /$item->bag->weight)/ 1000) * $item->weight,2);
        return view('admin.item.item_edit', compact('item','minimum_price', 'brand', 'category_type', 'type', 'bag', 'size', 'color'));
    }

    public function edititempost(ItemEditRequest $request, $id)
    {
        $newitem = Item::find($id);
        $newitem->bag_id = $request->input('bag_id');
        $newitem->brand_id = $request->input('brand_id');
        $newitem->category_type_id = $request->input('category_type_id');
        $newitem->type_id = $request->input('type_id');
        $newitem->size_id = $request->input('size_id');
        $newitem->color_id = $request->input('color_id');
        $newitem->cost = $request->input('cost');
        $newitem->price = $request->input('price');
        $bag = Bag::find($newitem->bag_id);
        $newitem->supplier_id = $bag->supplier_id;
        $brand = Brand::find($newitem->brand_id);
        $size = Size::find($newitem->size_id);
        if($newitem->discount != $request->discount)
        {
            $newitem->discount = $request->discount;
        $newitem->discount_user_id = Auth::user()->id;
        }
        if ($request->input('height_item') == null) {
            $newitem->height_item = 0;
        } else {
            $newitem->height_item = $request->input('height_item');
        }
        if ($request->input('width_item') == null) {
            $newitem->width_item = 0;
        } else {
            $newitem->width_item = $request->input('width_item');
        }
        $newitem->code = $brand->code . '-' . $size->code . '-' . $id;
        $newitem->weight = $request->input('weight');

        if ($request->image_main != null) {
            $imageName = $newitem->code . '.' . Request()->image_main->getClientOriginalExtension();
            Request()->image_main->move(public_path('images/item'), $imageName);
            $newitem->image_main = ($imageName);
        }
        $newitem->save();
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'edit item';
        $log->data_change = $newitem->code;
        $log->save();
        return redirect('admin/item')->with('message', 'Edit item Is Done!');
    }

    public function showitem($id)
    {
        $item = Item::find($id);
        return view('admin.item.item_show', compact('item'));
    }

    public function costitem()
    {
        $item = Item::where('price', '=', 0)->where('statues_item_store', '=', 1)->orderby('order')->with('bag1')->get();
        return view('admin.item.item_cost', compact('item'));
    }

    public function costitemcreateget($id)
    {
        $item = Item::with('bag')->find($id);
        if ($item->statues_item_store == 1 || $item->statues_item_store == 3) {
            return view('admin.item.item_cost_create', compact('item'));
        } else {
            return redirect()->back()->with('message_fales', 'Is Done!');
        }
    }

    public function costitemcreatepost(ItemCostEditRequest $request, $id)
    {
        $item = Item::with('bag')->find($id);
        if ($item->statues_item_store == 1) {
            if ($request->input('price') > 0) {
                $item->price = $request->input('price');
                $item->cost = (($item->bag->cost_buy / $item->bag->weight) / 1000) * $item->weight;
            } else {
                return redirect()->back()->with('message', 'price in not corect!');
            }
            $item->order = $request->input('order');
            $item->statues = 0;
            $item->statues_item_store = 2;
            $item->discount = $request->discount;
            $item->discount_user_id = Auth::user()->id;
            $item->update();
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'price item';
            $log->data_change = $item->code;
            $log->save();
            return redirect('admin/item/cost')->with('message', 'item Is Done!');
        } elseif ($item->statues_item_store == 3) {
            if ($request->input('price') > 0) {
                $item->price = $request->input('price');
                $item->cost = (($item->bag->cost_buy / $item->bag->weight) / 1000) * $item->weight;
            } else {
                return redirect()->back()->with('message', 'price in not corect!');
            }
            if($item->discount != $request->discount)
            {
            $item->discount = $request->discount;
            $item->discount_user_id = Auth::user()->id;
            }
            $item->order = $request->input('order');
            $item->save();
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'price item';
            $log->data_change = $item->code;
            $log->save();
            if ($item->statues == 1) {
                return redirect('admin/item/statues/active')->with('message', 'item Is Done!');
            } elseif ($item->statues == 0) {
                return redirect('admin/item/statues/dactive')->with('message', 'item Is Done!');
            }
        }
    }


    public function statuesactiveitem()
    {
        $item = Item::where('statues_item_store', '=', 3)->where('statues', '=', 1)->paginate(10);
        return view('admin.item.item_statues_active', compact('item'));
    }

    public function statuesdactiveitem()
    {
        $item = Item::where('statues_item_store', '=', 3)->where('statues', '=', 0)->paginate(10);
        return view('admin.item.item_statues_dactive', compact('item'));
    }

    public function editstatues($id)
    {
        $newitem = Item::find($id);
        if ($newitem->statues == 1) {
            $newitem->statues = '0';
        } elseif ($newitem->statues == 0) {
            $newitem->statues = '1';
        }
        $newitem->save();
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'change status item';
        $log->data_change = $newitem->code;
        $log->save();
        return redirect()->back()->with('message', 'Edit Statues Is Done!');
    }

    public function editallstatues(Request $request)
    {

        $newitem1 = Item::wherein('id', $request->service)->get();
        foreach ($newitem1 as $newitem) {
            if ($newitem->statues == 1) {
                $newitem->statues = '0';
            } elseif ($newitem->statues == 0) {
                $newitem->statues = '1';
            }
            $newitem->save();
            $log = new Log();
            $log->user_id = Auth::user()->id;
            $log->action_status = 'change status item';
            $log->data_change = $newitem->code;
            $log->save();
        }
        return redirect()->back()->with('message', 'Edit Statues Is Done!');
    }

    public function searchitemget()
    {
        $brand = DB::table("brandes")->pluck("name", "id");
        $category_type = DB::table("category_types")->pluck("name", "id");
        $type = DB::table("types")->pluck("name", "id");
        $size = DB::table("sizes")->pluck("name", "id");
        $color = DB::table("colores")->pluck("name", "id");
        return view('admin.item.item_search', compact('brand', 'category_type', 'type', 'size', 'color'));
    }

    public function searchitempost(Request $request)
    {
        if ($request->input('id') == null) {
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
            $item = Item::where('category_type_id', $category_type, $category_type_id)
                ->where('type_id', $type, $type_id)
                ->where('brand_id', $brand, $brand_id)
                ->where('size_id', $size, $size_id)
                ->where('color_id', $color, $color_id)->get();
            $count_item = count($item);
            if ($item == null) {
                return redirect()->back()->with('message_fales', 'not found');
            } else {
                if ($count_item == 1) {
                    return view('admin.item.item_search_index', compact('item', 'count_item'));
                } else {
                    return view('admin.item.item_search_index', compact('count_item', 'item'));
                }
            }
        } else {
            $item = Item::with('brand', 'category_type', 'type', 'bag', 'size', 'color')->find($request->input('id'));
            $count_item = 1;
            if ($item == null) {
                return redirect()->back()->with('message_fales', 'not found');
            } else {
                return view('admin.item.item_search_index', compact('item', 'count_item'));
            }
        }

    }

    public function storeinsertitem()
    {
        $item = Item::with('brand', 'bag', 'size', 'color')->where('statues_item_store', '=', 2)->get();
        return view('admin.item.item_store_insert', compact('item'));
    }

    public function locationitem($id)
    {
        $item = Item::find($id);
        if ($item->statues_item_store == 2) {
            $location = Location::where('id', '!=', 1)->get();
            return view('admin.item.location_insert', compact('item', 'location'));
        } else {
            return redirect()->back()->with('message_fales', 'Is Done!');
        }
    }

    public function insertitem($id, $id1)
    {
        $newitem = Item::find($id);
        $newlocation = Location::find($id1);
        $newlocation->count_item = $newlocation->count_item + 1;
        $newlocation->save();
        $newitem->statues_item_store = 3;
        $newitem->location_id = $id1;
        $newitem->save();
        $log = new Log();
        $log->user_id = Auth::user()->id;
        $log->action_status = 'insert to store item';
        $log->data_change = $newitem->code;
        $log->save();
        return redirect('/admin/item/storeinsert')->with('message', 'item insert to store');

    }

    public function storeitem()
    {
        $item = Item::where('statues_item_store', '=', 3)
            ->orwhere('statues_item_store', '=', 4)
            ->orwhere('statues_item_store', '=', 5)->paginate(10);
        return view('admin.item.item_store', compact('item'));
    }

    public function ImageItem()
    {
        return view('admin.item.image_item');
    }

    public function Imagesave(Request $request)
    {

        foreach ($request->image_main as $x) {

            $data1 = str_replace('.' . $x->getClientOriginalExtension(), '', $x->getClientOriginalname());
            $item = Item::where('code', $data1)->first();
            if ($item != null) {

                $x->move(public_path('images/item'), $x->getClientOriginalname());
            } else {
                $data[] = $x->getClientOriginalname();

            }
        }
        if (count($data) > 0) {
            return view('admin.item.error_image', compact('data'));
        } else {
            return redirect('/admin')->with('message', 'item insert to store');
        }
    }

    public function scraped($id)
    {
        $item = Item::find($id);
        if ($item->statues_item_store == 3) {
            $item->statues_item_store = 10;
            if ($item->statues == 1) {
                $item->statues = 0;
            }
            $item->update();
            return redirect()->back()->with('message', 'scraped Done');
        } else {
            return redirect()->back()->with('message_faled', 'scraped Can\'t');
        }
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
    public function getCostbag(Request $request)
    {
        $bag=Bag::find($request->bag_id);
        $minimum_price=number_format((($bag->cost_profit /$bag->weight)/ 1000) * $request->weight,2);
       $cost=number_format((($bag->cost_buy /$bag->weight)/ 1000) * $request->weight,2);
        $data['minimum_price']=$minimum_price;
        $data['cost']=$cost;
        return $data;
    }
}

?>