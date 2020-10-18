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
            <div align="center"><h3>{{ __('Edit Size') }}</h3></div>
            <form action="{{url('admin/size/edit/'.$size->id)}}"  method="post">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                        name : <input type="text" value="{{$size->name}}" class="form-control" name="name" placeholder="Enter You name">
                    </div>
                <div class="form-group{{ $errors->has('code') ? ' has-error' : "" }}">
                    code : <input type="text" value="{{$size->code}}" class="form-control" name="code" placeholder="Enter You code">
                </div>
                <div class="form-group{{ $errors->has('order') ? ' has-error' : "" }}">
                    order : <input type="text" value="{{$size->order}}" class="form-control" name="order" placeholder="Enter You order">
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