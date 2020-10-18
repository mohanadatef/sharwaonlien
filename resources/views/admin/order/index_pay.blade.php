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
        @include('includes.admin.error')
        <br>
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Order</h1>
                    </div>
                    <div align="center">
                        <a href="{{url('/admin')}}" class="btn btn-sm btn-primary">back</a>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($order) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">order number</th>
                                    <th class="center">count item</th>
                                    <th class="center">create by</th>
                                    <th class="center">will take</th>
                                    <th class="center">total price</th>
                                    <th class="center">control</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1; ?>
                                @foreach($order as $orders)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $orders->id }}</td>
                                        <td class="center">{{ $orders->count_item_order }}</td>
                                        <td class="center">{{ $orders->user_create_order->username }}</td>
                                        <td class="center">
                                            @if($orders->delivery == 0)
                                                {{ $orders->user_create_order->username }}
                                            @elseif($orders->delivery == 1)
                                                    {{ $orders->company_delivery->name }}
                                            @elseif($orders->delivery == 2)
                                                {{ $orders->name }}
                                            @endif
                                        </td>
                                        <td class="center">
                                            {{$orders->cost_after_discount}}
                                        </td>
                                        <td class="center">
                                            @permission('pay-order')
                                            <a href="{{ url('/admin/order/pay/'.$orders->id)}}" class="btn btn-sm btn-primary">pay</a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Item to show</div>
                    @endif
                </div>
            </div>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>