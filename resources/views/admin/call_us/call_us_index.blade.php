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
        <div class="page-content">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">call Reuest</h1>
                    </div>
                </div>
                    @if(count($call_us) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">name</th>
                                    <th class="center">email</th>
                                    <th class="center">message</th>
                                    @permission('call-us-delete')
                                    <th class="center">Control</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($call_us as $call)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $call->name }}</td>
                                        <td class="center">{{ $call->email }}</td>
                                        <td class="center">{{ $call->message }}</td>
                                        @permission('call-us-delete')
                                        <td class="center">
                                            <a href="{{url('admin/call_us/delete/'.$call->id)}}" onclick="return confirm('Are you sure?')"> <i class="ace-icon fa fa-trash bigger-120 "></i></a>
                                        </td>
                                        @endpermission
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no request to show</div>
                    @endif
                </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>