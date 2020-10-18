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
        <h1 align="center">Order Informaton</h1>
            <div align="right" style="margin-right: 40px;">
                @permission('order-ready')
                @foreach($order as $orders)
                    @if($orders->order->count_item_available == $orders->order->count_item_order)
                    <a href="{{ url('/admin/order/statues/'.$orders->order->id)}}" class="btn btn-sm btn-primary">ready</a>
                @endif
                    @break
                    @endforeach
                @endpermission
                <a href="{{  url('/admin/order/order_make_ready') }}" class="btn btn-sm btn-danger">back</a>
            </div>
            <div align="center" class="col-md-12 table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">code</th>
                        <th class="center">brand</th>
                        <th class="center">size</th>
                        <th class="center">color</th>
                  {{--      <th class="center">gender</th>--}}
                        <th class="center">type</th>
                        <th class="center">Location</th>
                        <th class="center">Image</th>
                        @if($orders->statues != 2)
                        <th class="center">control</th>
                            @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $orders)
                        <tr>
                            <td class="center">{{ $orders->item->code }}</td>
                            <td class="center">{{ $orders->item->brand->name}}</td>
                            <td class="center">{{ $orders->item->size->name}}</td>
                            <td class="center">{{ $orders->item->color->name}}</td>
                         {{--   <td class="center">{{ $orders->item->gender->name}}</td>--}}
                            <td class="center">{{ $orders->item->type->name}}</td>
                            <td class="center">{{ $orders->item->location->name}}</td>
                            <td class="center"><img src="{{ asset('public/images/item/' . $orders->item->image_main ) }}" style="width:100px;height: 100px"></td>
                            @if($orders->item->statues_item_store==0)
                            <td class="center"><a href="{{ url('/admin/order/statues_item/'.$orders->item->id)}}" class="btn btn-sm btn-danger">found</a></td>
                        @elseif($orders->item->statues_item_store==4)
                                <td class="center"><a href="{{ url('/admin/order/statues_item/'.$orders->item->id)}}" class="btn btn-sm btn-primary">not found</a></td>
                        @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>