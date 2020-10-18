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
        <div class="row" style="margin-right: 10px;margin-left: 10px">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Manage Bag</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if(count($bag) > 0)
                            <div align="center" class="col-md-12 table-responsive">
                                <table id="example1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">Name</th>
                                        <th class="center">cost buy</th>
                                        <th class="center">items</th>
                                        <th class="center">Averag cost</th>
                                        <th class="center">cost profit</th>
                                        @permission('bag-manage-edit')
                                        <th class="center">Control</th>
                                        @endpermission
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bag as $manage_bags)
                                        <tr>
                                            <td class="center">{{ $manage_bags->name }}</td>
                                            <td class="center">{{ $manage_bags->cost_buy }}</td>
                                            <td class="center">{{ $manage_bags->count_item }}</td>
                                            <td class="center">0</td>
                                            <td class="center">{{ $manage_bags->cost_profit }}</td>
                                            @permission('bag-manage-edit')
                                            <td class="center">
                                                <a href="{{ url('/admin/manage_bag/edit/'.$manage_bags->id)}}"><i
                                                            class="ace-icon fa fa-money">Pricing</i></a>
                                            </td>
                                            @endpermission
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty" align="center">There is no Manage Bag to show</div>
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