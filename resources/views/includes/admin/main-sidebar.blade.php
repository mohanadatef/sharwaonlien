<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Left side column. contains the logo and sidebar -->
        <ul class="sidebar-menu" data-widget="tree">

            @permission('core-data-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Data</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('location-show')
                    <li><a href="{{ url('admin/location') }}"><i class="fa fa-circle-o"></i>Location</a></li>
                    @endpermission
                    @permission('brand-show')
                    <li><a href="{{ url('admin/brand') }}"><i class="fa fa-circle-o"></i>Brand</a></li>
                    @endpermission
                    @permission('supplier-show')
                    <li><a href="{{ url('admin/supplier') }}"><i class="fa fa-circle-o"></i>
                            <span>Supplier</span></a></li>
                    @endpermission
               {{--     @permission('gender-show')
                    <li><a href="{{ url('admin/gender') }}"><i class="fa fa-circle-o"></i>
                            <span>Gender</span></a></li>
                    @endpermission--}}
                    @permission('color-show')
                    <li><a href="{{ url('admin/color') }}"><i class="fa fa-circle-o"></i> <span>Color</span></a>
                    </li>
                    @endpermission
                    @permission('size-show')
                    <li><a href="{{ url('admin/size') }}"><i class="fa fa-circle-o"></i>
                            <span>Size</span></a></li>
                    @endpermission
                    @permission('city-show')
                    <li><a href="{{ url('admin/city') }}"><i class="fa fa-circle-o"></i>
                            <span>City</span></a></li>
                    @endpermission
                    @permission('area-show')
                    <li><a href="{{ url('admin/area') }}"><i class="fa fa-circle-o"></i>
                            <span>Area</span></a></li>
                    @endpermission
                    @permission('category-type-show')
                    <li><a href="{{ url('admin/description') }}"><i class="fa fa-circle-o"></i> <span>description</span></a>
                    </li>
                    @endpermission
                    @permission('type-show')
                    <li><a href="{{ url('admin/type') }}"><i class="fa fa-circle-o"></i>
                            <span>Type</span></a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('bag-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i> <span>Bag</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('bag-show')
                    @permission('bag-show')
                    <li><a href="{{ url('admin/bag') }}"><i class="fa fa-circle-o"></i>
                            <span>All Bag</span></a></li>
                    @endpermission
            {{--        @permission('bag-show-complete')
                    <li><a href="{{ url('admin/bag/complete') }}"><i class="fa fa-circle-o"></i> <span>Completed Bag</span></a>
                    </li>
                    @endpermission
                    @endpermission
                    @permission('bag-manage-show')
                    @permission('bag-manage-show')
                    <li><a href="{{ url('admin/manage_bag') }}"><i class="fa fa-circle-o"></i><span>Manage Bag</span></a>
                    </li>
                    @endpermission
                    @permission('bag-manage-prices')
                    <li><a href="{{ url('admin/manage_bag/prices') }}"><i class="fa fa-circle-o"></i><span>Bag Pricing</span></a>
                    </li>
                    @endpermission--}}
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('item-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i> <span>Item</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('item-show')
                    <li><a href="{{ url('admin/item')}}"><i class="fa fa-circle-o"></i>All Item</a></li>
                    @endpermission
                    @permission('item-create')
                    <li><a href="{{ url('admin/item/create') }}"><i class="fa fa-circle-o"></i>Add Item</a></li>
                    @endpermission
                    @permission('item-cost')
                    <li><a href="{{ url('admin/item/cost') }}"><i class="fa fa-circle-o"></i>Pricing Item</a></li>
                    @endpermission
                    @permission('item-statues-active')
                    <li><a href="{{ url('admin/item/statues/active') }}"><i class="fa fa-circle-o"></i>Active
                            Item</a></li>
                    @endpermission
                    @permission('item-statues-dactive')
                    <li><a href="{{ url('admin/item/statues/dactive') }}"><i class="fa fa-circle-o"></i>Dactive Item</a>
                    </li>
                    @endpermission
                    @permission('item-search')
                    <li><a href="{{ url('admin/item/search') }}"><i class="fa fa-circle-o"></i>Search Item</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('store-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i> <span>Store</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('item-store')
                    <li><a href="{{ url('admin/item/store') }}"><i class="fa fa-circle-o"></i>All Item In Store </a></li>
                    @endpermission
                    @permission('item-store-insert')
                    <li><a href="{{ url('admin/item/storeinsert') }}"><i class="fa fa-circle-o"></i>Insert Item to Store </a></li>
                    @endpermission
                    @permission('make-order-ready')
                    <li><a href="{{ url('admin/order/order_make_ready')}}"><i class="fa fa-circle-o"></i>Order Preparation <span style="color: red"> {{$order_preparation}}</span></a></li>
                    @endpermission
                    @permission('order-change')
                    <li><a href="{{ url('admin/order/change') }}"><i class="fa fa-circle-o"></i>order have edit<span style="color: red"> {{$order_edit}}</span></a></li>
                    @endpermission
                    @permission('show-order-ready')
                    <li><a href="{{ url('admin/order/order_ready')}}"><i class="fa fa-circle-o"></i>Ready for Dispatch <span style="color: red"> {{$order_ready}}</span></a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('sales-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i> <span>Sales</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('show-your-order')
                    <li><a href="{{ url('admin/order/your')}}"><i class="fa fa-circle-o"></i>All Your Order</a></li>
                    @endpermission
                    @permission('make-order')
                    <li><a href="{{ url('admin/cart_item/make_order')}}"><i class="fa fa-circle-o"></i>New Order</a></li>
                    @endpermission
                    @permission('cart-item')
                    <li><a href="{{ url('admin/cart_item')}}"><i class="fa fa-circle-o"></i>Opened Order</a></li>
                    @endpermission
                    @permission('order-with')
                    <li><a href="{{ url('admin/order/with') }}"><i class="fa fa-circle-o"></i>Order With You</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('account-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Accountant</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('show-bills-order')
                    <li><a href="{{ url('admin/order/bills') }}"><i class="fa fa-circle-o"></i>Bills Order</a></li>
                    @endpermission
                    @permission('order-index-pay')
                    <li><a href="{{ url('admin/order/pay') }}"><i class="fa fa-circle-o"></i>Pay an Order</a></li>
                    @endpermission
                    @permission('order-search')
                    <li><a href="{{ url('admin/order/order_search') }}"><i class="fa fa-circle-o"></i>Search Order</a></li>
                    @endpermission
                    @permission('order-search-discarded')
                    <li><a href="{{ url('admin/order/order_search_discarded') }}"><i class="fa fa-circle-o"></i>search order for returned</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('report-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Report</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('report-order-discarded')
                    <li><a href="{{ url('admin/report/index_order_discarded') }}"><i class="fa fa-circle-o"></i>report discarded</a></li>
                    @endpermission
                    @permission('report-time-sales-show')
                    <li><a href="{{ url('admin/report/select_time') }}"><i class="fa fa-circle-o"></i>Report Sales By Time</a></li>
                    @endpermission
                    @permission('report-sales-index-all')
                    <li><a href="{{ url('admin/report/sales') }}"><i class="fa fa-circle-o"></i>Report Sales</a></li>
                    @endpermission
                    @permission('report-store-all')
                    <li><a href="{{ url('admin/report/store') }}"><i class="fa fa-circle-o"></i>Report Store</a></li>
                    @endpermission
                    @permission('report-time-data-show')
                    <li><a href="{{ url('admin/report/select_time/export') }}"><i class="fa fa-circle-o"></i>report item</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('import-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-upload"></i> <span>Import</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('import-item-image')
                    <li><a href="{{ url('admin/import/image/item')}}"><i class="fa fa-circle-o"></i>Image Item</a></li>
                    @endpermission
                    @permission('import-item-create')
                    <li><a href="{{ url('admin/import/item')}}"><i class="fa fa-circle-o"></i>Item</a></li>
                    @endpermission
                    @permission('import-brand-create')
                    <li><a href="{{ url('admin/import/brand')}}"><i class="fa fa-circle-o"></i>Brand</a></li>
                    @endpermission
                    @permission('import-city-create')
                    <li><a href="{{ url('admin/import/city')}}"><i class="fa fa-circle-o"></i>City</a></li>
                    @endpermission
                    @permission('import-area-create')
                    <li><a href="{{ url('admin/import/area')}}"><i class="fa fa-circle-o"></i>Area</a></li>
                    @endpermission
                    @permission('import-bag-create')
                    <li><a href="{{ url('admin/import/bag')}}"><i class="fa fa-circle-o"></i>Bag</a></li>
                    @endpermission
                    @permission('import-type-create')
                    <li><a href="{{ url('admin/import/type')}}"><i class="fa fa-circle-o"></i>Type</a></li>
                    @endpermission
                    @permission('import-category-type-create')
                    <li><a href="{{ url('admin/import/description')}}"><i class="fa fa-circle-o"></i>description</a></li>
                    @endpermission
                    @permission('import-color-create')
                    <li><a href="{{ url('admin/import/color')}}"><i class="fa fa-circle-o"></i>Color</a></li>
                    @endpermission
              {{--      @permission('import-gender-create')
                    <li><a href="{{ url('admin/import/gender')}}"><i class="fa fa-circle-o"></i>Gender</a></li>
                    @endpermission--}}
                    @permission('import-size-create')
                    <li><a href="{{ url('admin/import/size')}}"><i class="fa fa-circle-o"></i>Size</a></li>
                    @endpermission
                    @permission('import-company-delivery-create')
                    <li><a href="{{ url('admin/import/company_delivery')}}"><i class="fa fa-circle-o"></i>Company Delivery</a></li>
                    @endpermission
                    @permission('import-prices-delivery-create')
                    <li><a href="{{ url('admin/import/prices_delivery')}}"><i class="fa fa-circle-o"></i>Pricing Delivery</a></li>
                    @endpermission
                    @permission('import-user-delivery-create')
                    <li><a href="{{ url('admin/import/user_delivery')}}"><i class="fa fa-circle-o"></i>User Delivery</a></li>
                    @endpermission
                    @permission('import-supplier-create')
                    <li><a href="{{ url('admin/import/supplier')}}"><i class="fa fa-circle-o"></i>Supplier</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('user-list')
            <li class="treeview">
                <a href="#"><i class="fa fa-group"></i> <span>User</span><span class="pull-right-container"><i
                                class="fa fa-angle-right pull-left"></i></span></a>
                <ul class="treeview-menu">
                    @permission('user-show')
                    <li><a href="{{ url('/admin/user') }}"><i class="fa fa-group"></i><span>All User</span></a>
                    </li>
                    @endpermission
                    @permission('customer-show')
                    <li><a href="{{ url('/admin/customer') }}"><i class="fa fa-group"></i><span>All Customer</span></a>
                    </li>
                    @endpermission
                    @permission('role-show')
                    <li><a href="{{ url('/admin/role') }}"><i class="fa fa-at"></i><span>All Role</span></a>
                    </li>
                    @endpermission
                    @permission('permission-show')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> <span>Permission</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            @permission('permission-show')
                            <li><a href="{{ url('/admin/permission') }}"><i class="fa fa-group"></i><span>All Permission</span></a>
                            </li>
                            @endpermission
                            @permission('permission-create')
                            <li><a href="{{ url('/admin/permission/create') }}"><i
                                            class="fa fa-group"></i><span>Add Permission</span></a></li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('delivery-list')
            <li class="treeview">
                <a href="#"><i class="fa fa-car"></i> <span>Delivery Setting</span><span
                            class="pull-right-container"><i class="fa fa-angle-right pull-left"></i></span></a>
                <ul class="treeview-menu">
                    @permission('company-delivery-show')
                    <li><a href="{{ url('/admin/company_delivery') }}"><i class="fa fa-home"></i><span>All Delivery Companies</span></a>
                    </li>
                    @endpermission
                    @permission('user-delivery-show')
                    <li><a href="{{ url('/admin/user_delivery') }}"><i class="fa fa-group"></i><span>all User Delivery</span></a>
                    </li>
                    @endpermission
                    @permission('prices-delivery-show')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-circle-o"></i> <span>Delivery Pricing</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            @permission('prices-delivery-show')
                            <li><a href="{{ url('/admin/prices_delivery') }}"><i class="fa fa-group"></i><span>All Delivery Pricing</span></a>
                            </li>
                            @endpermission
                            @permission('prices-delivery-search')
                            <li><a href="{{ url('/admin/prices_delivery/search') }}"><i class="fa fa-search"></i><span>Search Delivery Pricing</span></a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('home-slider-list')
            <li class="treeview">
                <a href="#"><i class="fa fa-sliders"></i> <span>Home slider</span><span class="pull-right-container"><i class="fa fa-angle-right pull-left"></i></span></a>
                <ul class="treeview-menu">
                    @permission('home-slider-show')
                    <li><a href="{{ url('/admin/home_slider') }}"><i class="fa fa-sliders"></i><span>Home Slider</span></a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('job-list')
            <li class="treeview">
                <a href="#"><i class="fa fa-sliders"></i> <span>job</span><span class="pull-right-container"><i class="fa fa-angle-right pull-left"></i></span></a>
                <ul class="treeview-menu">
                    @permission('job-show')
                    <li><a href="{{ url('/admin/job') }}"><i class="fa fa-sliders"></i><span>job</span></a></li>
                    @endpermission
                    @permission('job-request-show')
                    <li><a href="{{ url('/admin/job_request') }}"><i class="fa fa-sliders"></i><span>job request</span></a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
            @permission('setting-list')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-server"></i> <span>Settings</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @permission('about-us-show')
                    <li><a href="{{ url('/admin/about_us') }}"><i class="fa fa-phone"></i><span>About Us</span></a></li>
                    @endpermission
                    @permission('contact-us-show')
                    <li><a href="{{ url('/admin/contact_us') }}"><i class="fa fa-phone"></i><span>Contact Us</span></a></li>
                    @endpermission
                    @permission('call-us-show')
                    <li><a href="{{ url('admin/call_us') }}"><i class="fa fa-circle-o"></i>call request</a></li>
                    @endpermission
                    @permission('setting-show')
                    <li><a href="{{ url('/admin/setting') }}"><i class="fa fa-phone"></i><span>Setting</span></a></li>
                    @endpermission
                    @permission('log-show')
                    <li><a href="{{ url('admin/log') }}"><i class="fa fa-circle-o"></i>Log</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
@yield('main-sidebar')
