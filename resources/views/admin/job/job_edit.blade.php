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
            <div align="center">{{ __('Edit job') }}</div>
            <form action="{{url('admin/job/edit/'.$job->id)}}"  method="POST">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
                <table class="table">
                    <tr>
                        <td>
                            <div class="form-group{{ $errors->has('tittel') ? ' has-error' : "" }}">
                                tittel : <input type="text" value="{{$job->tittel}}" class="form-control" name="tittel" placeholder="Enter You tittel">
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : "" }}">
                                description : <textarea type="text" id="description" class="form-control" name="description" placeholder="enter you frist_description">{{$job->description}}</textarea>
                            </div>
                            <div class="form-group{{ $errors->has('order') ? ' has-error' : "" }}">
                                order : <input type="text" value="{{$job->order}}" class="form-control" name="order" placeholder="Enter You order">
                            </div></td>
                    </tr>
                </table>
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