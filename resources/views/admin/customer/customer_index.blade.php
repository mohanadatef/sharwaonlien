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
        <br>
        @include('includes.admin.error')
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Customer</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($customer) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">Name</th>
                                    <th class="center">Email</th>
                                    <th class="center">Mobile</th>
                                    <th class="center">Address</th>
                                    @permission('user-statues')
                                    <th class="center">statues</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customer as $customers)
                                    <tr>
                                        <td class="center">{{ $customers->user->username }}</td>
                                        <td class="center">{{ $customers->user->email }}</td>
                                        <td class="center">{{ $customers->mobile }}</td>
                                        <td class="center">{{ $customers->address }}</td>
                                        @permission('user-statues')
                                        <td class="center">
                                            @if($customers->user->statues ==1)
                                                <h7>Active</h7><a href="{{ url('/admin/user/statues/'.$customers->user->id)}}"><i
                                                            class="ace-icon fa fa-close"></i></a>
                                            @elseif($customers->user->statues ==0)
                                                <h7>Dactive</h7><a href="{{ url('/admin/user/statues/'.$customers->user->id)}}"><i
                                                            class="ace-icon fa fa-check-circle"></i></a>
                                            @endif
                                        </td>
                                        @endpermission
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty">There is no Customer to show</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>