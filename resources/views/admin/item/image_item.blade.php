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
            <div align="center"><h3>{{ __('import image item') }}</h3></div>
            <form action="{{url('admin/import/image/item/save')}}" enctype="multipart/form-data" method="POST"
                  style="margin-right: 30px;margin-left: 30px">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('image_main') ? ' has-error' : "" }}">
                    <table class="table">
                        <tr>
                            <td width="40%" align="right"><label>Select File for Upload image main</label></td>
                            <td width="30"><input type="file" value="{{Request::old('image_main')}}" multiple='multiple' name="image_main[]"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"></td>
                            <td width="30"><span class="text-muted">jpg, png, gif</span></td>
                        </tr>
                    </table>
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-primary" value="import">
                </div>
            </form>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>