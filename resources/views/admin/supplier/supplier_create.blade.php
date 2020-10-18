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
            <div align="center"><h3>{{ __('Add Supplier') }}</h3></div>
            <form action="{{url('admin/supplier/create')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                    name : <input type="text" value="{{Request::old('name')}}" class="form-control" name="name" placeholder="Enter You name">
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : "" }}">
                    address : <input type="text" value="{{Request::old('address')}}" class="form-control" name="address" placeholder="Enter You address">
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : "" }}">
                    mobile : <input type="text" value="{{Request::old('mobile')}}" class="form-control" name="mobile" placeholder="Enter You mobile">
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : "" }}">
                    email : <input type="text" value="{{Request::old('email')}}" class="form-control" name="email" placeholder="Enter You email">
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