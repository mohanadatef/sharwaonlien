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
            <div align="center"><h3>{{ __('Edit Home Slider') }}</h3></div>
            <form action="{{url('admin/home_slider/edit/'.$homeslider->id)}}" enctype="multipart/form-data" method="POST" style="width: 1000px;margin-left: 50px">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('order') ? ' has-error' : "" }}">
                   order : <input type="text" id="order" value="{{$homeslider->order}}"
                                      class="form-control" name="order" placeholder="enter you order">
                </div>
                <div align="center">
                <img src="{{url('public/images/home_slider').'/'.$homeslider->image}}" style="width:300px;height:300px;">
                <div class="form-group{{ $errors->has('image') ? ' has-error' : "" }}">
                    <table class="table">
                        <tr>
                            <td width="40%" align="right"><label>Select File for Upload</label></td>
                            <td width="30"><input type="file" value="{{Request::old('image')}}" name="image" /></td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"></td>
                            <td width="30"><span class="text-muted">jpg, png, gif</span></td>
                        </tr>
                    </table>
                </div>
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-primary" value="Done">
                </div>
            </form>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>