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
            <form action="{{url('admin/order/order_search/index')}}" enctype="multipart/form-data" method="get" style="margin-right: 30px;margin-left: 30px">
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
                @permission('order-search-user')
                <div class="form-group">
                    user : <select id="user_create_id" name="user_create_id" type="user_create_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($user as $key => $myuser)
                            @if(in_array($key,$names_order))
                            <option value="{{$key}}"> {{$myuser}}</option>
                            @else
                            @endif
                        @endforeach
                    </select>
                </div>
                @endpermission
                @permission('order-search-company')
                <div class="form-group">
                    company : <select id="company_delivery_id" name="company_delivery_id" type="company_delivery_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($company_delivery as $key => $mycompany)
                            @if(in_array($key,$company_order))
                            <option value="{{$key}}"> {{$mycompany}}</option>
                            @else
                            @endif
                        @endforeach
                    </select>
                </div>
                @endpermission
                <input type="submit" class="btn btn-primary" value="search" style="margin-left: 450px;">
                <br>
            </form>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>