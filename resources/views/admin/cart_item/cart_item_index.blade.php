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
            <div class="col-md-8" >
                <h1 align="center">your order now</h1>
            </div>
            <div class="col-md-1">
                <a href="{{  url('/admin/cart_item/make_order') }}" class="btn btn-sm btn-primary">back</a>
            </div>
            @if(count($cart_item) > 0)
            @permission('finish-order')
            <div class="col-md-1">
                <a href="{{  url('/admin/cart_item/finish_order/'.Auth::user()->id) }}" class="btn btn-sm btn-yahoo">finish</a>
            </div>
            @endpermission
                @permission('finish-order-direct')
                <div class="col-md-2">
                    <a href="{{  url('/admin/cart_item/finish_direct/'.Auth::user()->id) }}" class="btn btn-sm btn-yahoo">finish direct</a>
                </div>
                @endpermission
                @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(count($cart_item) > 0)
                    <div align="center" class="col-md-12 table-responsive">
                        <table id="example1" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="center">id</th>
                                <th class="center">brand</th>
                                <th class="center">size</th>
                                <th class="center">color</th>
                         {{--       <th class="center">gender</th>--}}
                                <th class="center">type</th>
                                <th class="center">price</th>
                                <th class="center">discount</th>
                                <th class="center">Image</th>
                                @permission('cart-item-cancellation')
                                <th class="center">cancellation booked</th>
                                @endpermission
                                @permission('item-show-details')
                                <th class="center">Control</th>
                                @endpermission
                                @permission('item-discount')
                                <th class="center">discount</th>
                                @endpermission
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart_item as $myitem)
                                <tr>
                                        <td class="center">{{ $myitem->item->id}}</td>
                                        <td class="center">{{ $myitem->item->brand->name}}</td>
                                        <td class="center">{{ $myitem->item->size->name}}</td>
                                        <td class="center">{{ $myitem->item->color->name}}</td>{{--
                                        <td class="center">{{ $myitem->item->gender->name}}</td>--}}
                                        <td class="center">{{ $myitem->item->type->name}}</td>
                                        <td class="center">{{ $myitem->item->price}}</td>
                                        <td class="center">{{ $myitem->item->discount}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->item->image_main ) }}" style="width:100px;height: 100px"></td>
                                    @permission('cart-item-cancellation')
                                    <td class="center">
                                        <a href="{{ url('/admin/cart_item/cancellation/'.$myitem->id)}}"><i class=" fa fa-close" style="color: red">cancellation</i></a>
                                    </td>
                                    @endpermission
                                    @permission('item-show-details')
                                    <td class="center">
                                        <a href="{{ url('/admin/item/'.$myitem->id)}}"><i class=" fa fa-eye" style="color: green">show</i></a>
                                    </td>
                                    @endpermission
                                    <td class="center">
                                    @permission('item-discount')
                                    <button type="button" id="{{$myitem->item->id}}"
                                            onclick="selectItem('{{$myitem->item->id}}','{{$myitem->item->discount}}')"
                                            class="btn btn-sm btn-primary ace-icon fa fa-edit bigger-120  edit"
                                            data-toggle="modal"
                                            data-target="#modal-edit">
                                        Edit
                                    </button>
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
    @if(count($cart_item) != null)
        <div class="modal modal-info fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>

                        <section class="content-header">
                            <h1>
                                Discount
                            </h1>
                        </section>
                    </div>
                    <form id="size_edit" action="" method="POST">
                        <div class="modal-body">
                            <h3 align="center">Discount</h3>
                            <section class="content">
                                {{csrf_field()}}
                                <div class="form-group{{ $errors->has('order') ? ' has-error' : "" }}">
                                    discount : <input type="text" value="{{$myitem->item->discount}}" class="form-control" name="discount" id="discount" placeholder="Enter You discount">
                                </div>
                            </section>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline">Done</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
    <script>
        function selectItem(id, discount) {
            $('#size_edit').attr('action', "order/item/discount/" + id);
            $('#discount').val(discount);
        }
    </script>
</div>
</body>
</html>