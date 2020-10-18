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
                    <h1 align="center">Supplier</h1>
                </div>
                @permission('supplier-create')
                <div class="col-md-1" align="center">
                    <a href="{{  url('/admin/supplier/create') }}" class="btn btn-sm btn-primary">Add</a>
                </div>
                @endpermission
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($supplier) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">Name</th>
                                    <th class="center">Address</th>
                                    <th class="center">mobile</th>
                                    <th class="center">Email</th>
                                    @permission('supplier-statues')
                                    <th class="center">statues</th>
                                    @endpermission
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supplier as $supplieres)
                                    <tr>
                                        <td class="center">{{ $supplieres->name }}</td>
                                        <td class="center">{{ $supplieres->address }}</td>
                                        <td class="center">{{ $supplieres->mobile }}</td>
                                        <td class="center">{{ $supplieres->email }}</td>
                                        @permission('supplier-statues')
                                        <td class="center">
                                            @if($supplieres->statues ==1)
                                                <h7>Active</h7><a
                                                        href="{{ url('/admin/supplier/statues/'.$supplieres->id)}}"><i
                                                            class="ace-icon fa fa-close"></i></a>
                                            @elseif($supplieres->statues ==0)
                                                <h7>Dactive</h7><a
                                                        href="{{ url('/admin/supplier/statues/'.$supplieres->id)}}"><i
                                                            class="ace-icon fa fa-check-circle"></i></a>
                                            @endif
                                        </td>
                                        @endpermission
                                        <td class="center">
                                            @permission('supplier-edit')
                                            <a href="{{ url('/admin/supplier/edit/'.$supplieres->id)}}"><i
                                                        class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission
                                            @permission('supplier-show-details')
                                            <a href="{{ url('/admin/supplier/'.$supplieres->id)}}"><i class=" fa fa-eye"
                                                                                                      style="color: green">show</i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Supplier to show</div>
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