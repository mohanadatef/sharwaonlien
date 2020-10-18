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
                        <h1 align="center">Prices Delivery</h1>
                    </div>
                    @permission('prices-delivery-create')
                    <div class="col-md-1">
                        <a href="{{  url('/admin/prices_delivery/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    @endpermission
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($prices_delivery) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">company delivery</th>
                                    <th class="center">city</th>
                                    <th class="center">area</th>
                                    <th class="center">prices</th>
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($prices_delivery as $my_prices_delivery)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $my_prices_delivery->company_delivery->name }}</td>
                                        <td class="center">{{ $my_prices_delivery->city->name }}</td>
                                        <td class="center">{{ $my_prices_delivery->area->name }}</td>
                                        <td class="center">{{ $my_prices_delivery->prices }}</td>
                                        <td class="center">
                                            @permission('prices-delivery-edit')
                                            <a href="{{ url('/admin/prices_delivery/edit/'.$my_prices_delivery->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission
                                            @permission('prices-delivery-delete')
                                            <a href="{{url('admin/prices_delivery/delete/'.$my_prices_delivery->id)}}" onclick="return confirm('Are you sure?')"> <i class="ace-icon fa fa-trash bigger-120 " style="color: red">delete</i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Prices Delivery to show</div>
                    @endif
                </div>
            </div>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>