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
        <h1 align="center">Order Informaton</h1>
            <div align="right" style="margin-right: 40px;">
                <a href="{{  url('/admin/order/with') }}" class="btn btn-sm btn-danger">back</a>
            </div>
            <div align="center" class="col-md-12 table-responsive">
                <table id="example1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">code</th>
                        <th class="center">brand</th>
                        <th class="center">size</th>
                        <th class="center">color</th>
                     {{--   <th class="center">gender</th>--}}
                        <th class="center">type</th>
                        <th class="center">weight</th>
                        <th class="center">Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $orders)
                        <tr>
                            <td class="center">{{ $orders->item->code }}</td>
                            <td class="center">{{ $orders->item->brand->name}}</td>
                            <td class="center">{{ $orders->item->size->name}}</td>
                            <td class="center">{{ $orders->item->color->name}}</td>
                    {{--        <td class="center">{{ $orders->item->gender->name}}</td>--}}
                            <td class="center">{{ $orders->item->type->name}}</td>
                            <td class="center">{{ $orders->item->weight}}</td>
                            <td class="center"><img src="{{ asset('public/images/item/' . $orders->item->image_main ) }}" style="width:100px;height: 100px"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>