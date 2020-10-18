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
            <div align="center"><h3>{{ __('Edit Type') }}</h3></div>
            <form action="{{url('admin/type/edit/'.$type->id)}}"  method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                    name : <input type="text" value="{{$type->name}}" class="form-control" name="name" placeholder="Enter You name">
                </div>
                <div class="form-group{{ $errors->has('order') ? ' has-error' : "" }}">
                    order : <input type="text" value="{{$type->order}}" class="form-control" name="order" placeholder="Enter You order">
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