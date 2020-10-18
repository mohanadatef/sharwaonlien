<?php

namespace App\Providers;


use App\Models\ContactUs;

use App\Models\Item;
use App\Models\Order;
use App\Models\Setting;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['includes.frontend.*','frontend.*'], function ($view) {
            $contact_us=ContactUs::first();
            $setting=Setting::first();
            $discount = Item::where('statues', '=', 1)->where('statues_item_store', '=', 3)->where('discount','!=',0)->count();
            $item_type = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck("type_id", "id");
            $type = DB::table("types")->wherein('id',  $item_type)->pluck("name", "id");
            $item_size = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck("size_id", "id");
            $size = DB::table("sizes")->wherein('id',  $item_size)->pluck("name", "id");
            $item_color = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck("color_id", "id");
            $color = DB::table("colores")->wherein('id',  $item_color)->pluck("name", "id");
            $item_category_type = DB::table("items")->where('statues_item_store', '=', 3)->where('statues', '=', 1)->pluck("category_type_id", "id");
            $category_type = DB::table("category_types")->wherein('id',  $item_category_type)->pluck("name", "id");
            $data=array_merge($size->toArray(),$type->toArray(),$color->toArray(),$category_type->toArray());
            if(Cookie::get('cart') != null)
            {
                $prod = unserialize(Cookie::get('cart'));
                $prod=count($prod);
            }
            else
            {
                $prod[]=null;
            }
            $check=Cookie::get('check');
            $view->with('contact_us',$contact_us);
            $view->with('setting',$setting);
            $view->with('discount',$discount);
            $view->with('data',$data);
            $view->with('cookie',$prod);
            $view->with('size',$size);
            $view->with('type',$type);
            $view->with('color',$color);
            $view->with('category_type',$category_type);
            $view->with('check',$check);
        });
        view()->composer(['auth.login','includes.admin.header'], function ($view) {
            $setting=Setting::first();
            $view->with('setting',$setting);
        });
        view()->composer(['includes.admin.main-sidebar'], function ($view) {
        $order_preparation = Order::where('statues', 1)->count();
            $order_ready = Order::where('statues', 2)->count();
            $order_edit = Order::where('statues', 8)->count();
            $view->with('order_preparation',$order_preparation);
            $view->with('order_ready',$order_ready);
            $view->with('order_edit',$order_edit);
        });
    }
}
