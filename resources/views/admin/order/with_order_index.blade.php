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
        <div style="margin-bottom: -10px;">
            @include('includes.admin.error')
            <br>
            <h1 align="center">all Order with you</h1>
            @if(count($order) > 0)
            <div align="center" class="col-md-12 table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">order number</th>
                        <th class="center">count item</th>
                        <th class="center">Price</th>
                        <th class="center">control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $orders)
                    <tr>
                        <td class="center">{{ $orders->id }}</td>
                        <td class="center">{{ $orders->count_item_order }}</td>
                        <td class="center">{{ $orders->total_cost }}</td>
                        <td class="center">
                            <a href="{{ url('/admin/order/show_with/'.$orders->id)}}" class="btn btn-sm btn-primary">show</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty" align="center">There is no order to show</div>
            @endif
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>