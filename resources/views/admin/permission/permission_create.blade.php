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
            <div align="center">{{ __('Add Permission') }}</div>
            <form action="{{url('admin/permission/create')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                    name : <input type="text" value="{{Request::old('name')}}" class="form-control" name="name" placeholder="Enter You name">
                </div>
                <div class="form-group{{ $errors->has('display_name') ? ' has-error' : "" }}">
                    name display : <input type="text" value="{{Request::old('display_name')}}" class="form-control" name="display_name" placeholder="Enter You display_name">
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : "" }}">
                    description : <textarea type="text"  class="form-control" name="description" placeholder="Enter You description">{{Request::old('description')}}</textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Done ">
            </form>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>