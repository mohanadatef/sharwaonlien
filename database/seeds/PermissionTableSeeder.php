<?php
use Illuminate\Support\Facades\DB;
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permissions=[
            //core_data_list
            [
                'name'=>'core-data-list',
                'display_name'=>'core data list',
                'description'=>'list core data',
            ],
            //city
            [
                'name'=>'city-show',
                'display_name'=>'show city',
                'description'=>'show data in city',
            ],
            [
                'name'=>'city-create',
                'display_name'=>'create city',
                'description'=>'create data in city',
            ],
            [
                'name'=>'city-edit',
                'display_name'=>'edit city',
                'description'=>'edit data in city',
            ],
            [
                'name'=>'city-delete',
                'display_name'=>'delete city',
                'description'=>'delete data in city',
            ],
            //area
            [
                'name'=>'area-show',
                'display_name'=>'show area',
                'description'=>'show data in area',
            ],
            [
                'name'=>'area-create',
                'display_name'=>'create area',
                'description'=>'create data in area',
            ],
            [
                'name'=>'area-edit',
                'display_name'=>'edit area',
                'description'=>'edit data in area',
            ],
            [
                'name'=>'area-delete',
                'display_name'=>'delete area',
                'description'=>'delete data in area',
            ],
            //brand
            [
                'name'=>'brand-show',
                'display_name'=>'show brand',
                'description'=>'show data in brand',
            ],
            [
                'name'=>'brand-create',
                'display_name'=>'create brand',
                'description'=>'create data in brand',
            ],
            [
                'name'=>'brand-edit',
                'display_name'=>'edit brand',
                'description'=>'edit data in brand',
            ],
            [
                'name'=>'brand-delete',
                'display_name'=>'delete brand',
                'description'=>'delete data in brand',
            ],
            //gender
            [
                'name'=>'gender-show',
                'display_name'=>'show gender',
                'description'=>'show data in gender',
            ],
            [
                'name'=>'gender-create',
                'display_name'=>'create gender',
                'description'=>'create data in gender',
            ],
            [
                'name'=>'gender-edit',
                'display_name'=>'edit gender',
                'description'=>'edit data in gender',
            ],
            [
                'name'=>'gender-delete',
                'display_name'=>'delete gender',
                'description'=>'delete data in gender',
            ],
            //color
            [
                'name'=>'color-show',
                'display_name'=>'show color',
                'description'=>'show data in color',
            ],
            [
                'name'=>'color-create',
                'display_name'=>'create color',
                'description'=>'create data in color',
            ],
            [
                'name'=>'color-edit',
                'display_name'=>'edit color',
                'description'=>'edit data in color',
            ],
            [
                'name'=>'color-delete',
                'display_name'=>'delete color',
                'description'=>'delete data in color',
            ],
            //size
            [
                'name'=>'size-show',
                'display_name'=>'show size',
                'description'=>'show data in size',
            ],
            [
                'name'=>'size-create',
                'display_name'=>'create size',
                'description'=>'create data in size',
            ],
            [
                'name'=>'size-edit',
                'display_name'=>'edit size',
                'description'=>'edit data in size',
            ],
            [
                'name'=>'size-delete',
                'display_name'=>'delete size',
                'description'=>'delete data in size',
            ],
            //category type
            [
                'name'=>'category-type-show',
                'display_name'=>'show category type',
                'description'=>'show data in category type',
            ],
            [
                'name'=>'category-type-create',
                'display_name'=>'create category type',
                'description'=>'create data in category type',
            ],
            [
                'name'=>'category-type-edit',
                'display_name'=>'edit category type',
                'description'=>'edit data in category type',
            ],
            [
                'name'=>'category-type-delete',
                'display_name'=>'delete category type',
                'description'=>'delete data in category type',
            ],
            //type
            [
                'name'=>'type-show',
                'display_name'=>'show type',
                'description'=>'show data in type',
            ],
            [
                'name'=>'type-create',
                'display_name'=>'create type',
                'description'=>'create data in type',
            ],
            [
                'name'=>'type-edit',
                'display_name'=>'edit type',
                'description'=>'edit data in type',
            ],
            [
                'name'=>'type-delete',
                'display_name'=>'delete type',
                'description'=>'delete data in type',
            ],
            //supplier
            [
                'name'=>'supplier-show',
                'display_name'=>'show supplier',
                'description'=>'show data in supplier',
            ],
            [
                'name'=>'supplier-create',
                'display_name'=>'create supplier',
                'description'=>'create data in supplier',
            ],
            [
                'name'=>'supplier-edit',
                'display_name'=>'edit supplier',
                'description'=>'edit data in supplier',
            ],
            [
                'name'=>'supplier-delete',
                'display_name'=>'delete supplier',
                'description'=>'delete data in supplier',
            ],
            [
                'name'=>'supplier-show-details',
                'display_name'=>'show details supplier',
                'description'=>'show details in supplier',
            ],
            [
                'name'=>'supplier-statues',
                'display_name'=>'statues supplier',
                'description'=>'statues data in supplier',
            ],
            //bag_list
            [
                'name'=>'bag-list',
                'display_name'=>'bag list',
                'description'=>'list bag',
            ],
            //bag
            [
                'name'=>'bag-show',
                'display_name'=>'show bag',
                'description'=>'show data in bag',
            ],
            [
                'name'=>'bag-create',
                'display_name'=>'create bag',
                'description'=>'create data in bag',
            ],
            [
                'name'=>'bag-edit',
                'display_name'=>'edit bag',
                'description'=>'edit data in bag',
            ],
            [
                'name'=>'bag-show-complete',
                'display_name'=>'show complete bag',
                'description'=>'show complete data in bag',
            ],
            [
                'name'=>'bag-statues',
                'display_name'=>'statues bag',
                'description'=>'statues data in bag',
            ],
            [
                'name'=>'bag-complete',
                'display_name'=>'complete bag',
                'description'=>'complete data in bag',
            ],
            //bag_manage
            [
                'name'=>'bag-manage-show',
                'display_name'=>'show bag manage',
                'description'=>'show data in bag manage',
            ],
            [
                'name'=>'bag-manage-edit',
                'display_name'=>'edit bag manage',
                'description'=>'edit data in bag manage',
            ],
            [
                'name'=>'bag-manage-prices',
                'display_name'=>'prices bag manage',
                'description'=>'prices data in bag manage',
            ],
            //user_list
            [
                'name'=>'user-list',
                'display_name'=>'user list',
                'description'=>'list user',
            ],
            //user
            [
                'name'=>'user-show',
                'display_name'=>'show user',
                'description'=>'show data in user',
            ],
            [
                'name'=>'user-create',
                'display_name'=>'create user',
                'description'=>'create data in user',
            ],
            [
                'name'=>'user-edit',
                'display_name'=>'edit user',
                'description'=>'edit data in user',
            ],
            [
                'name'=>'user-delete',
                'display_name'=>'delete user',
                'description'=>'delete data in user',
            ],
            [
                'name'=>'user-password',
                'display_name'=>'password user',
                'description'=>'password data in user',
            ],
            [
                'name'=>'user-dactive',
                'display_name'=>'dactive user',
                'description'=>'dactive data in user',
            ],
            //role
            [
                'name'=>'role-show',
                'display_name'=>'show role',
                'description'=>'show data in role',
            ],
            [
                'name'=>'role-create',
                'display_name'=>'create role',
                'description'=>'create data in role',
            ],
            [
                'name'=>'role-edit',
                'display_name'=>'edit role',
                'description'=>'edit data in role',
            ],
            [
                'name'=>'role-delete',
                'display_name'=>'delete role',
                'description'=>'delete data in role',
            ],
            //permission
            [
                'name'=>'permission-show',
                'display_name'=>'permission show',
                'description'=>'show permission',
            ],
            [
                'name'=>'permission-create',
                'display_name'=>'create permission',
                'description'=>'create data in permission',
            ],
            [
                'name'=>'permission-edit',
                'display_name'=>'edit permission',
                'description'=>'edit data in permission',
            ],
            [
                'name'=>'permission-delete',
                'display_name'=>'delete permission',
                'description'=>'delete data in permission',
            ],
            //dashboard
            [
                'name'=>'dashboard-show',
                'display_name'=>'dashboard show',
                'description'=>'show dashboard',
            ],
            //item_list
            [
                'name'=>'item-list',
                'display_name'=>'item list',
                'description'=>'list item',
            ],
            //item
            [
                'name'=>'item-show',
                'display_name'=>'show item',
                'description'=>'show data in item',
            ],
            [
                'name'=>'item-show-details',
                'display_name'=>'show details item',
                'description'=>'show details data in item',
            ],
            [
                'name'=>'item-create',
                'display_name'=>'create item',
                'description'=>'create data in item',
            ],
            [
                'name'=>'item-edit',
                'display_name'=>'edit item',
                'description'=>'edit data in item',
            ],
            [
                'name'=>'item-delete',
                'display_name'=>'delete item',
                'description'=>'delete data in item',
            ],
            [
                'name'=>'item-cost',
                'display_name'=>'cost item',
                'description'=>'cost data in item',
            ],
            [
                'name'=>'item-cost-create',
                'display_name'=>'cost create item',
                'description'=>'cost create data in item',
            ],
            [
                'name'=>'item-statues',
                'display_name'=>'statues item',
                'description'=>'statues data in item',
            ],
            [
                'name'=>'item-statues-active',
                'display_name'=>'statues active item',
                'description'=>'statues active data in item',
            ],
            [
                'name'=>'item-statues-dactive',
                'display_name'=>'statues dactive item',
                'description'=>'statues dactive data in item',
            ],
            [
                'name'=>'item-status-change',
                'display_name'=>'status change item',
                'description'=>'status change data in item',
            ],
            [
                'name'=>'item-search',
                'display_name'=>'search item',
                'description'=>'search data in item',
            ],
            [
                'name'=>'item-search-index',
                'display_name'=>'search index item',
                'description'=>'search index data in item',
            ],
            [
                'name'=>'item-search-code',
                'display_name'=>'search code item',
                'description'=>'search code data in item',
            ],
            [
                'name'=>'item-search-choose',
                'display_name'=>'search choose item',
                'description'=>'search choose data in item',
            ],
            //delivery_list
            [
                'name'=>'delivery-list',
                'display_name'=>'delivery list',
                'description'=>'list delivery',
            ],
            //company-delivery
            [
                'name'=>'company-delivery-show',
                'display_name'=>'show company delivery',
                'description'=>'show data in company delivery',
            ],
            [
                'name'=>'company-delivery-show-details',
                'display_name'=>'show details company delivery',
                'description'=>'show details data in company delivery',
            ],
            [
                'name'=>'company-delivery-create',
                'display_name'=>'create company delivery',
                'description'=>'create data in company delivery',
            ],
            [
                'name'=>'company-delivery-edit',
                'display_name'=>'edit company delivery',
                'description'=>'edit data in company delivery',
            ],
            [
                'name'=>'company-delivery-delete',
                'display_name'=>'delete company delivery',
                'description'=>'delete data in company delivery',
            ],
            [
                'name'=>'company-delivery-cost',
                'display_name'=>'cost company delivery',
                'description'=>'cost data in company delivery',
            ],
            [
                'name'=>'company-delivery-statues',
                'display_name'=>'statues company delivery',
                'description'=>'statues data in company delivery',
            ],
            //user-delivery
            [
                'name'=>'user-delivery-show',
                'display_name'=>'show user delivery',
                'description'=>'show data in user delivery',
            ],
            [
                'name'=>'user-delivery-create',
                'display_name'=>'create user delivery',
                'description'=>'create data in user delivery',
            ],
            [
                'name'=>'user-delivery-edit',
                'display_name'=>'edit user delivery',
                'description'=>'edit data in user delivery',
            ],
            [
                'name'=>'user-delivery-delete',
                'display_name'=>'delete user delivery',
                'description'=>'delete data in user delivery',
            ],
            //prices-delivery
            [
                'name'=>'prices-delivery-show',
                'display_name'=>'show prices delivery',
                'description'=>'show data in prices delivery',
            ],
            [
                'name'=>'prices-delivery-create',
                'display_name'=>'create prices delivery',
                'description'=>'create data in prices delivery',
            ],
            [
                'name'=>'prices-delivery-edit',
                'display_name'=>'edit prices delivery',
                'description'=>'edit data in prices delivery',
            ],
            [
                'name'=>'prices-delivery-delete',
                'display_name'=>'delete prices delivery',
                'description'=>'delete data in prices delivery',
            ],
        ];
        foreach ($permissions as $key=>$value)
        {
            Permission::create($value);
        }
    }
}