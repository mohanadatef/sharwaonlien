<!DOCTYPE html>
<html>
<head>
    @include('includes.admin.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('includes.admin.main-header')
    @include('includes.admin.main-sidebar')
    <div class="content-wrapper">
        <div style="margin-bottom: -10px;">
            @include('includes.admin.error')
            <br>
            <h1 align="center">Order Ready</h1>
            @if(count($order) > 0)
            <div align="center" class="col-md-12 table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">order number</th>
                        <th class="center">count item</th>
                        <th class="center">create by</th>
                        <th class="center">will take</th>
                        <th class="center">control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $orders)
                    <tr>
                        <td class="center">{{ $orders->id }}</td>
                        <td class="center">{{ $orders->count_item_order }}</td>
                        <td class="center">{{ $orders->user_create_order->username }}</td>
                        <td class="center">
                            @if($orders->delivery == 0)
                            {{ $orders->user_create_order->username }}
                            @elseif($orders->delivery == 1)
                            @if($orders->company_delivery->id ==2)
                                    must choose company first
                            @else
                            {{ $orders->company_delivery->name }}
                            @endif
                            @elseif($orders->delivery == 2)
                                {{ $orders->name }}
                            @endif
                        </td>
                        <td class="center">
                            @permission('check-order')
                            <a href="{{ url('/admin/order/show_ready/'.$orders->id)}}" class="btn btn-sm btn-primary">show to check</a>
                            @endpermission
                            @permission('change-order-ready')
                                <a href="{{ url('/admin/order/order_ready_change/'.$orders->id)}}" class="btn btn-sm btn-tumblr">no ready</a>
                        @endpermission
                            @if($orders->delivery == 0 || $orders->delivery == 1)
                            <a href="{{ url('/admin/order/order_out/'.$orders->id)}}" class="btn btn-sm btn-danger">out</a>
                                @elseif($orders->delivery == 2 && $orders->statues == 2)
                                must pay first
                                @elseif($orders->delivery == 2 && $orders->statues == 6)
                                    <a href="{{ url('/admin/order/order_out/'.$orders->id)}}" class="btn btn-sm btn-danger">out</a>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty" align="center">There is no order to show</div>
            @endif
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>