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
        <div class="col-md-12">
            <br>
            <div align="center"><h3>{{ __('Add Contact Us') }}</h3></div>
            <form action="{{url('admin/contact_us/create')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('address') ? ' has-error' : "" }}">
                    address : <input type="text" value="{{Request::old('address')}}" class="form-control" name="address" placeholder="Enter You address">
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : "" }}">
                    email : <input type="text" value="{{Request::old('email')}}" class="form-control" name="email" placeholder="Enter You email">
                </div>
                <div class="form-group{{ $errors->has('latitude') ? ' has-error' : "" }}">
                    latitude : <input type="text" value="{{Request::old('latitude')}}" class="form-control" name="latitude" placeholder="Enter You latitude">
                </div>
                <div class="form-group{{ $errors->has('longitude') ? ' has-error' : "" }}">
                    longitude : <input type="text" value="{{Request::old('longitude')}}" class="form-control" name="longitude" placeholder="Enter You longitude">
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : "" }}">
                    phone : <input type="text" value="{{Request::old('phone')}}" class="form-control" name="phone" placeholder="Enter You phone">
                </div>
                <div align="center">
                <input type="submit" class="btn btn-primary" value="Done">
                </div>
            </form>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>