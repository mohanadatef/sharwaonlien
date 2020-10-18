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
                    <h1 align="center">Location</h1>
                </div>
                @permission('location-create')
                <div class="col-md-1" align="center">
                    <a href="{{  url('/admin/location/create') }}" class="btn btn-sm btn-primary">Add</a>
                </div>
                <br>
                @endpermission
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($location) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">Name</th>
                                    <th class="center">space</th>
                                    <th class="center">count item</th>
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($location as $mylocation)
                                    <tr>
                                        <td class="center">{{ $mylocation->name }}</td>
                                        <td class="center">{{ $mylocation->space }}</td>
                                        <td class="center">{{ $mylocation->count_item }}</td>
                                        <td class="center">
                                            @permission('location-edit')
                                            <a href="{{ url('/admin/location/edit/'.$mylocation->id)}}"><i
                                                        class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Location to show</div>
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