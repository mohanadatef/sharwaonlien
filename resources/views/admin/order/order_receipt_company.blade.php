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
        <div style="margin-right: 30px;margin-left: 30px">
            <div align="center">{{ __('order Informations') }}</div>
                number order : <input type="text" disabled value="{{$order->id}}" class="form-control" >
                name : <input type="text" disabled value="{{$order->name}}" class="form-control" >
                    address : <input type="text" disabled value="{{$order->address}}" class="form-control" >
                mobile : <input type="text" disabled value="{{$order->mobile}}" class="form-control" >
                cost order : <input type="text" disabled value="{{$order->total_cost}}" class="form-control" >
                cost delivery : <input type="text" disabled value="{{$order->prices_delivery}}" class="form-control" >
            total : <input type="text" disabled value="{{$order->total_cost + $order->prices_delivery}}" class="form-control" >
                notes : <input type="text" disabled value="{{$order->notes}}" class="form-control" >
                <div align="center">
                    <a href="{{url('/admin/order/'.$order->id.'/print')}}" class="btn btn-sm btn-primary">print</a>
                    <a href="{{url('/admin/order/order_make_ready')}}" class="btn btn-sm btn-primary">done</a>
                </div>
            <br>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>