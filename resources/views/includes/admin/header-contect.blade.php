<!-- Small boxes (Stat box) -->
<div class="row">
    @permission('all-order-count')
    <!--All order -->
    <a href="{{ url('admin/order/your')}}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $order }}</h3>

                <p>All Orders</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-preparation-count')
    <!--All order preparation-->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $order_preparation }} EL</h3>

                <p>Reserved</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    @endpermission
    @permission('order-ready-count')
    <!--All order ready-->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $order_ready }} EL</h3>

                <p>Ready Of Dispatch</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    @endpermission
    @permission('order-must-pay-count')
    <!--All order must pay-->
    <a href="{{ url('admin/order/with') }}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $order_must_pay }} EL</h3>

                <p>Credit</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-edit-count')
    <!--All order edit-->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $order_edit }}</h3>

                <p>Errors</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    @endpermission
    @permission('order-discarded-count')
    <!--All order edit-->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $order_discarded }}</h3>

                <p>Returned</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    @endpermission
    <!------------>
    @permission('all-order-count-system')
    <!--All order -->
    <a href="{{ url('admin/report/sales') }}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $order_all }} EL</h3>

                <p>Sales</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-preparation-count-system')
    <!--All order preparation-->
    <a href="{{ url('admin/order/order_make_ready')}}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $order_preparation_all }} EL</h3>

                <p>Reserved</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-ready-count-system')
    <!--All order ready-->
    <a href="{{ url('admin/order/order_ready')}}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $order_ready_all }} EL</h3>

                <p>Ready Of Dispatch</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-must-pay-count-system')
    <!--All order must pay-->
    <a href="{{ url('admin/order/pay') }}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $order_must_pay_all }} EL</h3>

                <p>Credit</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-edit-count-system')
    <!--All order edit-->
    <a href="{{ url('admin/order/change') }}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $order_edit_all }}</h3>

                <p>Errors</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
    @permission('order-discarded-count-system')
    <!--All order edit-->
    <a href="{{ url('admin/report/index_order_discarded') }}">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $order_discarded_all }}</h3>

                <p>Returned</p>
            </div>
            <div class="icon">
                <i class="fa fa-hospital-o"></i>
            </div>
        </div>
    </div>
    </a>
    @endpermission
</div>
@yield('header-contect')