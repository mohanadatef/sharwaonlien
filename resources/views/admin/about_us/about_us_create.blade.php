<!DOCTYPE html>
<html>
<head>
    @include('includes.admin.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
@include('includes.admin.main-header')
@include('includes.admin.main-sidebar')
<div class="wrapper">
    <div class="content-wrapper">
        @include('includes.admin.error')
        <div class="col-md-12">
        <br>
        <div align="center"><h3>{{ __('Add About US') }}</h3></div>
        <form action="{{url('admin/about_us/create')}}" enctype="multipart/form-data" method="POST"
              style="width: 1000px;margin-left: 50px">
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('description') ? ' has-error' : "" }}">
                description : <textarea type="text" value="{{Request::old('description')}}"
                                           class="form-control" name="description"></textarea>
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : "" }}">
                <table class="table">
                    <tr>
                        <td width="40%" align="right"><label>Select File for Upload</label></td>
                        <td width="30"><input type="file" value="{{Request::old('image')}}" name="image"/></td>
                    </tr>
                    <tr>
                        <td width="40%" align="right"></td>
                        <td width="30"><span class="text-muted">jpg, png, gif</span></td>
                    </tr>
                </table>
            </div>
            <div align="center">
            <input type="submit" class="btn btn-primary" value="Done" >
            </div>
        </form>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>