<!DOCTYPE html>
<html>
<head>
    @include('includes.admin.header')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/admin/multi-select.css')}}">
    <style>

        .ms-container {
            width: 50%;
        }

        li.ms-elem-selectable, .ms-selected {
            padding: 5px !important;
        }

        .ms-list {
            height: 310px !important;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('includes.admin.main-header')
    @include('includes.admin.main-sidebar')
    <div class="content-wrapper">
        @include('includes.admin.error')
     <br>
            <div class="card">
                <div align="center">{{ __('Add User') }}</div>
                <div class="card-body">
                    <form action="{{url('admin/user/create')}}" method="POST" style="margin-left: 30px;margin-right: 30px">
                        {{csrf_field()}}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : "" }}">
                            Name : <input type="text" value="{{Request::old('username')}}" class="form-control" name="username"
                                          placeholder="Enter You name">
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : "" }}">
                            email : <input type="text" value="{{Request::old('email')}}" class="form-control"
                                           name="email" placeholder="Enter You email">
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : "" }}">
                            password : <input type="password" value="{{Request::old('password')}}" class="form-control"
                                              name="password" placeholder="Enter You password">
                        </div>
                        <div class="form-group">
                            password confirmation : <input type="password" value="{{Request::old('password')}}"
                                                           class="form-control" name="password_confirmation"
                                                           placeholder="Enter You password">
                        </div>
                        <div class="form-group"  style="margin-left:450px; ">
                            choose Roles :
                        </div>
                        <div class="form-group"  style="margin-left:300px; ">
                            <select id="role_id" multiple='multiple' name="role_id[]">
                                @foreach($role as  $myrole)
                                    @if($myrole->id == '1' || $myrole->id == '3' )
                                        @else
                                    <option value="{{$myrole->id}}"> {{$myrole->display_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Done"  style="margin-left:450px; ">
                    </form>
                    <br>
                </div>
            </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="{{url('public/js/admin/jquery.multi-select.js')}}"></script>
    <script>
        $('#role_id').multiSelect();
    </script>
</div>
</body>
</html>