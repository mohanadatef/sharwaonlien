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
                        <h1 align="center">Color</h1>
                    </div>
                    @permission('color-create')
                    <div class="col-md-1" align="center">
                        <a href="{{  url('/admin/color/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    <br>
                    @endpermission
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if(count($color) > 0)
                            <div align="center" class="col-md-12 table-responsive">
                                <table id="example1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">Name</th>
                                        <th class="center">Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($color as $colores)
                                        <tr>
                                            <td class="center">{{ $colores->name }}</td>
                                            <td class="center">
                                                @permission('color-edit')
                                                <a href="{{ url('/admin/color/edit/'.$colores->id)}}"><i
                                                            class="ace-icon fa fa-edit bigger-120  edit"
                                                            data-id="">edit</i></a>
                                                @endpermission

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty" align="center">There is no Color to show</div>
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