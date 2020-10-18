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
   @if($count_item==1)
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
           {{--         gender : <input type="text" disabled value="{{$item->gender->name}}" class="form-control" >--}}
                    weight : <input type="text" disabled value="{{$item->weight}}" class="form-control" >
                <br>
                    <img src="{{ asset('public/images/item/' . $item->image_main ) }}" style="width:100px;height: 100px">
                <div align="center">
                    <a href="{{url( '/admin/item/search') }}" class="btn btn-sm btn-primary">search</a>
                </div>
                <br>
            </div>
        @else
        <br>
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Item</h1>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($item) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">code</th>
                                    <th class="center">status</th>
                                    <th class="center">brand</th>
                                    <th class="center">size</th>
                                    <th class="center">color</th>
                                    {{--      <th class="center">gender</th>--}}
                                    <th class="center">type</th>
                                    <th class="center">weight</th>
                                    <th class="center">cost</th>
                                    <th class="center">price</th>
                                    <th class="center">location</th>
                                    <th class="center">Image</th>
                                    @permission('item-show-details')
                                    <th class="center">Control</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item as $myitem)
                                    <tr>
                                        <td class="center">{{ $myitem->code}}</td>
                                        @if($myitem->statues_item_store == 0)
                                            <td class="center">not found</td>
                                        @elseif($myitem->statues_item_store == 1)
                                            <td class="center">wait priceing</td>
                                        @elseif($myitem->statues_item_store == 2)
                                            <td class="center">add to store</td>
                                        @elseif($myitem->statues_item_store == 3)
                                            <td class="center">inventory</td>
                                        @elseif($myitem->statues_item_store == 4)
                                            <td class="center">reserved</td>
                                        @elseif($myitem->statues_item_store == 5)
                                            <td class="center">ready for dispatch</td>
                                        @elseif($myitem->statues_item_store == 6)
                                            <td class="center">delivered</td>
                                        @elseif($myitem->statues_item_store == 7)
                                            <td class="center">dispatch</td>
                                        @elseif($myitem->statues_item_store == 8)
                                            <td class="center">dispatch w_sales</td>
                                        @elseif($myitem->statues_item_store == 9)
                                            <td class="center">paid</td>
                                        @elseif($myitem->statues_item_store == 10)
                                            <td class="center">scraped</td>
                                        @endif
                                        <td class="center">{{ $myitem->brand->name}}</td>
                                        <td class="center">{{ $myitem->size->name}}</td>
                                        <td class="center">{{ $myitem->color->name}}</td>
              {{--                          <td class="center">{{ $myitem->gender->name}}</td>--}}
                                        <td class="center">{{ $myitem->type->name}}</td>
                                        <td class="center">{{ $myitem->weight}}</td>
                                        <td class="center">{{ $myitem->cost}}</td>
                                        <td class="center">{{ $myitem->price}}</td>
                                        <td class="center">{{ $myitem->location->name}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->image_main ) }}" style="width:100px;height: 100px"></td>
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
       @endif
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>