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
                <div class="row" style="margin-right: 10px">
                    <div class="col-md-10">
                        <h1 align="center">Item</h1>
                    </div>
                    <div class="col-md-1">
                        <a href="{{  url('/admin/cart_item/make_order') }}" class="btn btn-sm btn-primary">back</a>
                    </div>
                    <div class="col-md-1">
                        <a href="{{  url('/admin/cart_item') }}" class="btn btn-sm btn-info">your order</a>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($item) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">id</th>
                                    <th class="center">brand</th>
                                    <th class="center">size</th>
                                    <th class="center">color</th>
                         {{--           <th class="center">gender</th>--}}
                                    <th class="center">type</th>
                                    <th class="center">price</th>
                                    <th class="center">Image</th>
                                    @permission('cart-item-select')
                                    <th class="center">Select</th>
                                    @endpermission
                                    @permission('item-show-details')
                                    <th class="center">Control</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item as $myitem)
                                    <tr>
                                        <td class="center">{{ $myitem->id}}</td>
                                        <td class="center">{{ $myitem->brand->name}}</td>
                                        <td class="center">{{ $myitem->size->name}}</td>
                                        <td class="center">{{ $myitem->color->name}}</td>
   {{--                                     <td class="center">{{ $myitem->gender->name}}</td>--}}
                                        <td class="center">{{ $myitem->type->name}}</td>
                                        <td class="center">{{ $myitem->price}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->image_main ) }}" style="width:100px;height: 100px"></td>
                                        @permission('cart-item-select')
                                        <td class="center">
                                        <a href="{{url( '/admin/cart_item/select/'.$myitem->id) }}" class="btn btn-sm btn-primary">select</a>
                                        </td>
                                            @endpermission
                                        @permission('item-show-details')
                                        <td class="center">
                                            <a href="{{ url('/admin/item/'.$myitem->id)}}"><i class=" fa fa-eye" style="color: green">show</i></a>
                                        </td>
                                        @endpermission
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