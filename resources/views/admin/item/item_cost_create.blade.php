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
            <div align="center"><h3>{{ __('add cost') }}</h3></div>
            <form action="{{url('admin/item/cost/create/'.$item->id)}}"  method="POST" style="margin-left: 30px;margin-right: 30px;">
                {{csrf_field()}}
                <div class="form-group">
                    code : <input type="text" disabled value="{{$item->code}}" class="form-control" >
                </div>
                <div class="form-group">
                    bag : <input type="text" disabled value="{{$item->bag->name}}" class="form-control" >
                </div>
            <div class="form-group">
                weight : <input type="text" disabled value="{{$item->weight}}" class="form-control" >
            </div>
                <div class="form-group">
                    Minimum Price : <input type="text" disabled value="{{number_format((($item->bag->cost_profit /$item->bag->weight)/ 1000) * $item->weight,2)}}" class="form-control" >
                </div>
            <div class="form-group">
               Cost : <input type="text" disabled value="{{number_format( (($item->bag->cost_buy /$item->bag->weight)/ 1000) * $item->weight,2)}}" class="form-control" >
            </div>
            <div class="form-group">
                <img src="{{ asset('public/images/item/' . $item->image_main ) }}" style="width:100px;height: 100px">
            </div>
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : "" }}">
                    price : <input type="text" value="{{$item->price}}" class="form-control" name="price" placeholder="Enter You price">
                </div>
                <div class="form-group{{ $errors->has('discount') ? ' has-error' : "" }}">
                    discount : <input type="text" value="{{$item->discount}}" class="form-control"
                                      name="discount" placeholder="Enter You discount">
                </div>
                <div class="form-group">
                    order : <input type="text"  value="{{$item->order}}" class="form-control" name="order" placeholder="Enter You order">
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