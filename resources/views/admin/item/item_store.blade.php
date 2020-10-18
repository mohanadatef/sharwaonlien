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
                    <div class="col-md-11">
                        <h1 align="center">Store</h1>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($item) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    @permission('scraped-item')
                                    <th class="center">Scraped</th>
                                    @endpermission
                                    <th class="center">statues</th>
                                    <th class="center">bag</th>
                                    <th class="center">code</th>
                                    <th class="center">description</th>
                                    <th class="center">type</th>
                                    <th class="center">brand</th>
                                    <th class="center">size</th>
                                    {{--<th class="center">gender</th>--}}
                                    <th class="center">supplier</th>
                                    <th class="center">color</th>
                                    <th class="center">location</th>
                                    <th class="center">Image</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item as $myitem)
                                    <tr>
                                        @permission('scraped-item')
                                        @if($myitem->statues_item_store == 3)
                                            <td class="center">
                                                <a href="{{ url('/admin/item/scraped/'.$myitem->id)}}"><i class=" fa fa-insert" onclick="return confirm('Are you sure?')">Scraped</i></a>
                                            </td>
                                        @else
                                            <td class="center"></td>
                                        @endif
                                        @endpermission
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
                                        <td class="center">{{ $myitem->bag->name}}</td>
                                        <td class="center">{{ $myitem->code}}</td>
                                        <td class="center">{{ $myitem->category_type->name}}</td>
                                        <td class="center">{{ $myitem->type->name}}</td>
                                        <td class="center">{{ $myitem->brand->name}}</td>
                                        <td class="center">{{ $myitem->size->code}}</td>
                                        <td class="center">{{ $myitem->supplier->name}}</td>
                                        <td class="center">{{ $myitem->color->name}}</td>
                                        <td class="center">{{ $myitem->location->name}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->image_main ) }}" style="width:100px;height: 100px"></td>
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
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>


