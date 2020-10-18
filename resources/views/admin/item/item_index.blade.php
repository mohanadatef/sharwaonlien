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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Item</h1>
                    </div>
                    @permission('item-create')
                    <div class="col-md-1" align="center">
                        <a href="{{  url('/admin/item/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    <br>
                    @endpermission
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if(count($item) > 0)
                            <div align="center" class="col-md-12 table-responsive">
                                <table id="example1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">code</th>
                                        <th class="center">bag</th>
                                        <th class="center">type</th>
                                        <th class="center">weight</th>
                                        <th class="center">cost</th>
                                        <th class="center">price</th>
                                        <th class="center">status</th>
                                        <th class="center">Image</th>
                                        <th class="center">Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($item as $myitem)
                                        <tr>
                                            <td class="center">{{ $myitem->code}}</td>
                                            <td class="center">{{ $myitem->bag->name}}</td>
                                            <td class="center">{{ $myitem->type->name}}</td>
                                            <td class="center">{{ $myitem->weight}}</td>
                                            <td class="center">{{ $myitem->cost}}</td>
                                            <td class="center">{{ $myitem->price}}</td>
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
                                            <td class="center"><img
                                                        src="{{ asset('public/images/item/' . $myitem->image_main ) }}"
                                                        style="width:100px;height: 100px"></td>
                                            <td class="center">
                                                @permission('item-edit')
                                                <a href="{{ url('/admin/item/edit/'.$myitem->id)}}"><i
                                                            class="ace-icon fa fa-edit bigger-120  edit"
                                                            data-id="">edit</i></a>
                                                @endpermission
                                                @permission('item-show-details')
                                                <a href="{{ url('/admin/item/'.$myitem->id)}}"><i class=" fa fa-eye"
                                                                                                  style="color: green">show</i></a>
                                                @endpermission
                                                @permission('item-cost')
                                                @if($myitem->cost == 0 )
                                                    <a href="{{ url('/admin/item/cost/create/'.$myitem->id)}}"><i
                                                                class="ace-icon fa fa-money">pricing</i></a>
                                                @endif
                                                @endpermission
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $item->links() }}
                            </div>
                        @else
                            <div class="empty" align="center">There is no Item to show</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>


