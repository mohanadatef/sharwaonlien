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
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Permission</h1>
                    </div>
                    @permission('permission-create')
                    <div class="col-md-1">
                        <a href="{{  url('/admin/permission/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    @endpermission
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($permission) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">name</th>
                                    <th class="center">display name</th>
                                    <th class="center">description</th>
                                    <th class="center">contor</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($permission as $mypermission)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $mypermission->name }}</td>
                                        <td class="center">{{ $mypermission->display_name }}</td>
                                        <td class="center">{!! $mypermission->description !!}</td>
                                        <td class="center">
                                            @permission('permission-edit')
                                            <a href="{{ url('/admin/permission/edit/'.$mypermission->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Permission to show</div>
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