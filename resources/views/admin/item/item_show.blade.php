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
            <div align="center">{{ __('item') }}</div>
                             code : <input type="text" disabled value="{{$item->code}}" class="form-control" >
                    bag : <input type="text" disabled value="{{$item->bag->name}}" class="form-control" >
                supplier : <input type="text" disabled value="{{$item->supplier->name}}" class="form-control" >
            description : <input type="text" disabled value="{{$item->category_type->name}}" class="form-control" >
                type : <input type="text" disabled value="{{$item->type->name}}" class="form-control" >
                color : <input type="text" disabled value="{{$item->color->name}}" class="form-control" >
                size : <input type="text" disabled value="{{$item->size->name}}" class="form-control" >
                brand : <input type="text" disabled value="{{$item->brand->name}}" class="form-control" >
               {{-- gender : <input type="text" disabled value="{{$item->gender->name}}" class="form-control" >--}}
                weight : <input type="text" disabled value="{{$item->weight}}" class="form-control" >
                discount : <input type="text" disabled value="{{$item->discount}}" class="form-control" >
                width  : <input type="text" disabled value="{{$item->width_item}}" class="form-control" >
                height : <input type="text" disabled value="{{$item->height_item}}" class="form-control" >
            <br>
                <img src="{{ asset('public/images/item/' . $item->image_main ) }}" style="width:100px;height: 100px">
                <div align="center">
                    <a href="{{url('/admin/item')}}" class="btn btn-sm btn-primary">back</a>
                </div>
            <br>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>