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
            <div align="center"><h3>{{ __('Setting') }}</h3></div>
            <form action="{{url('admin/setting/edit/'.$setting->id)}}" enctype="multipart/form-data" method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('facebook') ? ' has-error' : "" }}">
                    facebook : <input type="text" value="{{$setting->facebook}}" class="form-control" name="facebook" placeholder="enter you facebook">
                </div>
                <div class="form-group{{ $errors->has('instgram') ? ' has-error' : "" }}">
                    instgram : <input type="text" value="{{$setting->instgram}}" class="form-control" name="instgram" placeholder="enter you instgram">
                </div>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : "" }}">
                    <table class="table">
                        <tr>
                            <td><img src="{{url('public/images/setting').'/'.$setting->image}}"
                                     style="width:300px;height:300px;margin-left:400px "></td>
                        </tr>
                        <tr>
                            <td width="40%" align="center"><label>Select File for Upload</label></td>
                            <td width="30" align="center"><input type="file" value="{{Request::old('image')}}"
                                                                 name="image"/></td>
                        </tr>
                        <tr>
                            <td width="40%" align="center"></td>
                            <td width="30" align="center"><span class="text-muted">jpg, png, gif</span></td>
                        </tr>
                    </table>
                </div>

                <div class="form-group{{ $errors->has('logo') ? ' has-error' : "" }}">
                    <table class="table">
                        <tr>
                            <td><img src="{{url('public/images/setting').'/'.$setting->logo}}"
                                     style="width:300px;height:300px;margin-left:400px "></td>
                        </tr>
                        <tr>
                            <td width="40%" align="center"><label>Select File for Upload</label></td>
                            <td width="30" align="center"><input type="file" value="{{Request::old('logo')}}"
                                                                 name="logo"/></td>
                        </tr>
                        <tr>
                            <td width="40%" align="center"></td>
                            <td width="30" align="center"><span class="text-muted">jpg, png, gif</span></td>
                        </tr>
                    </table>
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