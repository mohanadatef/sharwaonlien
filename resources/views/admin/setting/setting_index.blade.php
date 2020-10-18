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
                        <h1 align="center">Setting</h1>
                    </div>
                    @permission('setting-create')
                    @if($setting->count() == 0)
                        <div class="col-md-1">
                            <a href="{{  url('/admin/setting/create') }}" class="btn btn-sm btn-primary">Add</a>
                        </div>
                    @endif
                    <br>
                    @endpermission
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($setting) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">facebook</th>
                                    <th class="center">instgram</th>
                                    <th class="center">image</th>
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($setting as $sett)
                                    <tr>
                                        <td class="center">{{ $sett->facebook }}</td>
                                        <td class="center">{{ $sett->instgram }}</td>
                                        <td class="center"><img src="{{ asset('public/images/setting/' . $sett->image ) }}" style="width:100px;height: 100px"></td>
                                        <td class="center">
                                            @permission('setting-edit')
                                            <a href="{{ url('/admin/setting/edit/'.$sett->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id=""></i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Data to show</div>
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