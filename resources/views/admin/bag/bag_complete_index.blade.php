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
        <h1 align="center">Bag Complete</h1>
        @if(count($bag) > 0)
            <div align="center" class="col-md-12 table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th class="center">Name</th>
                        <th class="center">weight</th>
                        @permission('bag-statues')
                        <th class="center">statues</th>
                        @endpermission
                        @permission('bag-complete')
                        <th class="center">complete</th>
                        @endpermission
                        <th class="center">supplier</th>
                        <th class="center">user by</th>
                        <th class="center">user create</th>
                        <th class="center">Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1; ?>
                    @foreach($bag as $bags)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td class="center">{{ $bags->name }}</td>
                            <td class="center">{{ $bags->weight }}</td>
                            @permission('bag-statues')
                            <td class="center">
                                @if($bags->statues ==1)
                                    <h7>Active</h7>
                                @elseif($bags->statues ==0)
                                        <h7>Dactive</h7>
                                @endif
                            </td>
                            @endpermission
                            @permission('bag-complete')
                            <td class="center">
                                <h7>Complete</h7><a href="{{ url('/admin/bag/complete/'.$bags->id)}}" style="color: green"><i class="ace-icon fa fa-close"></i></a>
                            </td>
                            @endpermission
                            <td class="center">
                                @permission('supplier-show-details')<a
                                        href="{{ url('/admin/supplier/'.$bags->supplier->id)}}">@endpermission{{ $bags->supplier->name }}
                                    @permission('supplier-show-details')</a>@endpermission
                            </td>
                            <td class="center">{{ $bags->user_buy->username }}</td>
                            <td class="center">{{ $bags->user_create->username }}</td>
                            <td class="center">
                                @permission('bag-edit')
                                <a href="{{ url('/admin/bag/edit/'.$bags->id)}}"><i
                                            class="ace-icon fa fa-edit bigger-120  edit" data-id="">edit</i></a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty" align="center">There is no Bag to show</div>
        @endif
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>