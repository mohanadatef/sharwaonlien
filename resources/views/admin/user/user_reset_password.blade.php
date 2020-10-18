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
            <div class="card">
                <h1 align="center">Reset Passw0rd</h1>
                <div class="card-body">
                    <form action="{{url('admin/user/reset/'.$user->id)}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : "" }}">
                            password : <input type="password" value="{{Request::old('password')}}" class="form-control" name="password" placeholder="Enter You password">
                        </div>
                        <div class="form-group">
                            password confirmation : <input type="password" value="{{Request::old('password')}}" class="form-control" name="password_confirmation" placeholder="Enter You password">
                        </div>
                        <div align="center">
                            <input type="submit" class="btn btn-primary" value="Reset ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>