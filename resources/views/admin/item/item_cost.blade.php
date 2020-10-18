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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Cost Item</h1>
                    </div>
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
                                    <th class="center">Image</th>
                                    <th class="center">cost weight bag</th>
                                    <th class="center">min cost to item</th>
                                    <th class="center">cost</th>
                                    <th class="center">price</th>
                                    @permission('item-cost-create')
                                    <th class="center">Control</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item as $myitem)
                                    <tr>
                                        <td class="center">{{ $myitem->code}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->image_main ) }}" style="width:100px;height: 100px"></td>
                                        <td class="center">{{ $myitem->bag->cost_buy / 1000 * $myitem->bag->weight}}</td>
                                        <td class="center">{{ $myitem->bag->cost_profit / 1000 * $myitem->weight}}</td>
                                        <td class="center">{{ $myitem->cost}}</td>
                                        <td class="center">{{ $myitem->price}}</td>
                                        @permission('item-cost-create')
                                        <td class="center">
                                            <a href="{{ url('/admin/item/cost/create/'.$myitem->id)}}"><i class=" fa fa-money" >pricing</i></a>
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