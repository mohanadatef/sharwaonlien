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
                        <h1 align="center">Company delivery</h1>
                    </div>
                    @permission('company-delivery-create')
                    <div class="col-md-1">
                        <a href="{{  url('/admin/company_delivery/create') }}" class="btn btn-sm btn-primary">Add</a>
                    </div>
                    @endpermission
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($company_delivery) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">Name</th>
                                    <th class="center">mobile</th>
                                    <th class="center">performance</th>
                                    @permission('company-delivery-statues')
                                    <th class="center">statues</th>
                                    @endpermission
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($company_delivery as $my_company_delivery)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $my_company_delivery->name }}</td>
                                        <td class="center"><a href="tel:{{ $my_company_delivery->mobile }}">{{ $my_company_delivery->mobile }}</a></td>
                                        <td class="center">{{ $my_company_delivery->performance }}</td>
                                        @permission('company-delivery-statues')
                                        <td class="center">
                                            @if($my_company_delivery->statues ==1)
                                                <h7>Active</h7><a href="{{ url('/admin/company_delivery/statues/'.$my_company_delivery->id)}}"><i
                                                            class="ace-icon fa fa-close"></i></a>
                                            @elseif($my_company_delivery->statues ==0)
                                                    <h7>Dactive</h7><a href="{{ url('/admin/company_delivery/statues/'.$my_company_delivery->id)}}"><i
                                                                class="ace-icon fa fa-check-circle"></i></a>
                                            @endif
                                        </td>
                                        @endpermission
                                        <td class="center">
                                            @permission('company-delivery-edit')
                                            <a href="{{ url('/admin/company_delivery/edit/'.$my_company_delivery->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                            @endpermission
                                            @permission('company-delivery-show-details')
                                            <a href="{{url('admin/company_delivery/'.$my_company_delivery->id)}}"> <i class="ace-icon fa fa-eye bigger-120 " style="color: green">show</i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Company delivery to show</div>
                    @endif
                </div>
            </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>