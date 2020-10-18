<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\import\ImportCreateRequest;
use App\Imports\TempletItemImport;
use App\Models\Bag;
use App\Models\Brand;
use App\Models\CategoryType;
use App\Models\Color;/*
use App\Models\Gender;*/
use App\Models\Item;
use App\Models\Location;
use App\Models\Log;
use App\Models\Size;
use App\Models\TempletItem;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class TempletItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indextempletitem()
    {
        $templet_item = TempletItem::all();
        return view('admin.import.item.import_item_index', compact('templet_item'));
    }

    public function importExportView()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        return view('/admin/import/item');
    }

    public function importitemget()
    {
        return view('admin.import.item.import_item');
    }

    public function importitempost(ImportCreateRequest $request)
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        TempletItem::truncate();
        Excel::import(new TempletItemImport(), request()->file('file'));
        $templet_item = TempletItem::find(1);
        $templet_item->delete();
        return redirect('/admin/import/index/item')->with('message', 'Add Templet Is Done');
    }

    public function unmatchedItemGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $matched_result = DB::table("brandes")->rightjoin('templet_items', 'brandes.name', '=', 'templet_items.brand')
            ->where('brandes.name', '=', null)
            ->select('templet_items.brand')
            ->groupBy('templet_items.brand')
            ->get();
        $brandname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($brandname, $matched_result[$i]->brand);
        }
        $brandname = array_diff($brandname, ['', 'null']);
        $matched_result = DB::table("bags")->rightjoin('templet_items', 'bags.name', '=', 'templet_items.bag')
            ->where('bags.name', '=', null)
            ->select('templet_items.bag')
            ->groupBy('templet_items.bag')
            ->get();
        $bagname = [];
        foreach($matched_result as $x)
        {
            array_push($bagname, $x->bag);
        }
        $bagname = array_diff($bagname, ['', 'null']);
        $matched_result = DB::table("category_types")->rightjoin('templet_items', 'category_types.name', '=', 'templet_items.category_type')
            ->where('category_types.name', '=', null)
            ->select('templet_items.category_type')
            ->groupBy('templet_items.category_type')
            ->get();
        $category_typename = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($category_typename, $matched_result[$i]->category_type);
        }
        $category_typename = array_diff($category_typename, ['', 'null']);
        $matched_result = DB::table("colores")->rightjoin('templet_items', 'colores.name', '=', 'templet_items.color')
            ->where('colores.name', '=', null)
            ->select('templet_items.color')
            ->groupBy('templet_items.color')
            ->get();
        $colorname = [];

        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($colorname, $matched_result[$i]->color);
        }
        $colorname = array_diff($colorname, ['', 'null']);
       /* $matched_result = DB::table("genderes")->rightjoin('templet_items', 'genderes.name', '=', 'templet_items.gender')
            ->where('genderes.name', '=', null)
            ->select('templet_items.gender')
            ->groupBy('templet_items.gender')
            ->get();
        $gendername = [];

        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($gendername, $matched_result[$i]->gender);
        }
        $gendername = array_diff($gendername, ['', 'null']);*/
        $matched_result = DB::table("locations")->rightjoin('templet_items', 'locations.name', '=', 'templet_items.location')
            ->where('locations.name', '=', null)
            ->select('templet_items.location')
            ->groupBy('templet_items.location')
            ->get();
        $locationname = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($locationname, $matched_result[$i]->location);
        }
        $locationname = array_diff($locationname, ['', 'null']);
        $matched_result = DB::table("sizes")->rightjoin('templet_items', 'sizes.code', '=', 'templet_items.size')
            ->where('sizes.code', '=', null)
            ->select('templet_items.size')
            ->groupBy('templet_items.size')
            ->get();
        $sizename = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($sizename, $matched_result[$i]->size);
        }
        $sizename = array_diff($sizename, ['', 'null']);
        $matched_result = DB::table("types")->rightjoin('templet_items', 'types.name', '=', 'templet_items.type')
            ->where('types.name', '=', null)
            ->select('templet_items.type')
            ->groupBy('templet_items.type')
            ->get();
        $typename = [];
        for ($i = 0; $i < count($matched_result); $i++) {
            array_push($typename, $matched_result[$i]->type);
        }
        $typename = array_diff($typename, ['', 'null']);
     /*   $count_error = count($brandname+$bagname+$category_typename+$colorname+$gendername+$sizename+$typename);*/
        $count_error = count($brandname+$bagname+$category_typename+$colorname+$sizename+$typename+$locationname);
        if ($count_error > 0) {
            return view('admin.import.item.error_item', compact('brandname',
                'bagname','category_typename','colorname','sizename','typename'));
            /*    return view('admin.import.item.error_item', compact('brandname',
                'bagname','category_typename','colorname','gendername','sizename','typename'));*/
        } else {
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='importsheet item';
            $log->data_change=' ';
            $log->save();
            return view('admin.import.item.save_item');
        }
    }

    public function SaveItemGrouped()
    {
        ini_set('max_execution_time', 120000);
        ini_set('post_max_size', 120000);
        ini_set('upload_max_filesize', 100000);
        $templet_item = TempletItem::all();
        foreach ($templet_item as $templet) {
            $item = Item::all()->last();
            if ($item == null) {
                $id = 1;
            } else {
                $id = $item->id + 1;
            }
            $newitem = new Item();
            $bag = Bag::where('name',$templet->bag)->first();
            $newitem->bag_id = $bag->id;
            $category_type = CategoryType::where('name',$templet->category_type)->first();
            $newitem->category_type_id = $category_type->id;
            $type = Type::where('name',$templet->type)->first();
            $newitem->type_id = $type->id;
            $size = Size::where('code',$templet->size)->first();
            $newitem->size_id = $size->id;
            $color = Color::where('name',$templet->color)->first();
            $newitem->color_id = $color->id;
          /*  $gender = Gender::where('name',$templet->gender)->first();
            $newitem->gender_id = $gender->id;*/
            $brand = Brand::where('name',$templet->brand)->first();
            $newitem->brand_id = $brand->id;
            $newitem->price = $templet->price;
            $newitem->cost = $templet->cost;
            $newitem->discount = $templet->discount;
            $newitem->discount_user_id = Auth::user()->id;
            $newitem->order = 1000;
            $newitem->statues = 0;
            $newitem->count_item = 1;
            $newitem->statues_item_store = 3;
            if ($templet->height_item == null) {
                $newitem->height_item = 0;
            } else {
                $newitem->height_item = $templet->height_item;
            }
            if ($templet->width_item == null) {
                $newitem->width_item = 0;
            } else {
                $newitem->width_item = $templet->width_item;
            }
            $newitem->user_create_id = Auth::user()->id;
            $bag = Bag::find($newitem->bag_id);
            $newitem->supplier_id = $bag->supplier_id;
            $x = $bag->count_item;
            $bag->count_item = $x + 1;
            $newitem->code = $brand->code . '-' . $size->code . '-' . $id;
            $newitem->weight = $templet->weight;
            $newitem->image_main = $templet->image_main;
            $location = Location::where('name',$templet->location)->first();
            $location->count_item=$location->count_item+1;
            $newitem->location_id = $location->id;
            $newitem->save();
            $bag->save();
            $log = new Log();
            $log->user_id=Auth::user()->id;
            $log->action_status='createitem';
            $log->data_change=$newitem->code;
            $log->save();
        }
        return redirect('admin/item')->with('message', 'Add item Is Done');
    }
}

?>