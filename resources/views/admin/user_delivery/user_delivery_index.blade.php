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
                        <h1 align="center">User Delivery</h1>
                    </div>
                    @permission('user-delivery-create')
                    <div class="col-md-1">
                        <a href="{{  url('/admin/user_delivery/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    @endpermission
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($user_delivery) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">Name</th>
                                    <th class="center">moile</th>
                                    <th class="center">position</th>
                                    <th class="center">company delivery</th>
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($user_delivery as $my_user_delivery)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $my_user_delivery->name }}</td>
                                        <td class="center">{{ $my_user_delivery->mobile }}</td>
                                        <td class="center">{{ $my_user_delivery->position }}</td>
                                        <td class="center">{{ $my_user_delivery->company_delivery->name }}</td>
                                        <td class="center">
                                            @permission('user-delivery-edit')
                                            <a href="{{ url('/admin/user_delivery/edit/'.$my_user_delivery->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission
                                            @permission('user-delivery-delete')
                                            <a href="{{url('admin/user_delivery/delete/'.$my_user_delivery->id)}}" onclick="return confirm('Are you sure?')"> <i class="ace-icon fa fa-trash bigger-120 " style="color: red">delete</i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no User Delivery to show</div>
                    @endif
                </div>
            </div>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>