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
            <h1 align="center">all your Order</h1>
            @if(count($order) > 0)
            <div align="center" class="col-md-12 table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">order number</th>
                        <th class="center">count item</th>
                        <th class="center">total cost</th>
                        <th class="center">statues</th>
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
                        <td class="center">{{ $orders->total_cost }}</td>
                        <td class="center">
                        @if($orders->statues==0 )
                                The request is ongoing
                        @elseif($orders->statues==1)
                                The processing is done
                        @elseif($orders->statues==2)
                                Ready to receive
                        @elseif($orders->statues==3)
                                Received by employee
                        @elseif($orders->statues==4)
                                Received by shipping company
                        @elseif($orders->statues==5)
                                Received by customer
                        @elseif($orders->statues==6)
                                The payment was made
                            @elseif($orders->statues==7)
                                The order have problem
                            @elseif($orders->statues==10)
                                The order finish
                        @endif
                        </td>
                        <td class="center">{{ $orders->user_create_order->username }}</td>
                        <td class="center">
                            @if($orders->delivery == 0)
                            {{ $orders->user_create_order->username }}
                            @elseif($orders->delivery == 1)
                            @if($orders->company_delivery->id ==2)
                                    company
                            @else
                            {{ $orders->company_delivery->name }}
                            @endif
                            @elseif($orders->delivery == 2)
                                {{ $orders->name }}
                            @endif
                        </td>
                        <td class="center">
                            <a href="{{ url('/admin/order/show_you/'.$orders->id)}}" class="btn btn-sm btn-primary">show</a>
                            @if($orders->statues ==1 ||$orders->statues ==2)
                                <a href="{{ url('/admin/order/edit/'.$orders->id)}}" class="btn btn-sm btn-primary">edit</a>
                                <a href="{{ url('/admin/order/cansal/'.$orders->id)}}" class="btn btn-sm btn-primary">cansal</a>
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