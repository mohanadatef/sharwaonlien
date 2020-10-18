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
            <div align="center">{{ __('Order Information') }}</div>
            <form action="{{url('admin/order/'.$order->id)}}"  method="POST" style="margin-right: 30px;margin-left: 30px;">
                {{csrf_field()}}
                    order number : <input type="text" disabled value="{{$order->id}}" class="form-control">
                total cost : <input type="text" disabled value="{{$order->total_cost}}" class="form-control">
                total cost : <input type="text" disabled value="{{$order->cost_after_discount}}" class="form-control">
                <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : "" }}">
                    delivery : <select id="delivery" type="delivery" class="form-control" name="delivery" >
                        <option value="0"  selected > ساقوم انا بالاستلام من الشركه</option>
                        <option value="1"> ارسال عن طريق شركه شحن عن طريق الشركه</option>
                        <option value="2">العميل سوف يقوم بالاستلام بنفسه</option>
                    </select>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                    name : <input type="text" value="{{$order->name}}" class="form-control" name="name" placeholder="Enter You name">
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : "" }}">
                    mobile : <input type="text" value="{{$order->mobile}}" class="form-control" name="mobile" placeholder="Enter You mobile">
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : "" }}">
                    address : <input type="text" value="{{$order->address}}" class="form-control" name="address" placeholder="Enter You address">
                </div>
                <div class="form-group{{ $errors->has('notes') ? ' has-error' : "" }}">
                    notes : <textarea type="text"  class="form-control" name="notes" >{{$order->notes}}</textarea>
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-primary" value="Done">
                </div>
            </form>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>