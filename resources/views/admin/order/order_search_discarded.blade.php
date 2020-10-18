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
            <div align="center">{{ __('Search order') }}</div>
            <form action="{{url('admin/order/order_search_discarded/index')}}" enctype="multipart/form-data" method="POST" style="margin-right: 30px;margin-left: 30px">
                {{csrf_field()}}
                @permission('order-search-number')
                <div class="form-group{{ $errors->has('id') ? ' has-error' : "" }}">
                    order number : <input type="text" value="{{Request::old('id')}}" class="form-control" name="id" placeholder="Enter You order number">
                </div>
                @endpermission
                @permission('order-search-mobile')
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : "" }}">
                    mobile : <input type="text" value="{{Request::old('mobile')}}" class="form-control" name="mobile" placeholder="Enter You mobile">
                </div>
                @endpermission
                <input type="submit" class="btn btn-primary" value="search" >
                <br>
            </form>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>