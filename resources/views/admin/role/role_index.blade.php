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
                        <h1 align="center">Role</h1>
                    </div>
                    @permission('role-create')
                    <div class="col-md-1">
                        <a href="{{  url('/admin/role/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    @endpermission
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($role) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">name</th>
                                    <th class="center">display name</th>
                                    <th class="center">description</th>
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($role as $myrole)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $myrole->name }}</td>
                                        <td class="center">{{ $myrole->display_name }}</td>
                                        <td class="center">{!! $myrole->description !!}</td>
                                        <td class="center">
                                           {{-- @if( $myrole->name == 'owner')
                                                on permission to do this
                                            @else--}}
                                            @permission('role-edit')
                                            <a href="{{ url('/admin/role/edit/'.$myrole->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission
                                          {{--  @endif--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Role to show</div>
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