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
            <div align="center">{{ __('Edit User Delivery') }}</div>
            <form action="{{url('admin/user_delivery/edit/'.$user_delivery->id)}}"  method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                    name : <input type="text" value="{{$user_delivery->name}}" class="form-control" name="name" placeholder="Enter You name">
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : "" }}">
                    mobile : <input type="text" value="{{$user_delivery->mobile}}" class="form-control" name="mobile" placeholder="Enter You mobile">
                </div>
                <div class="form-group{{ $errors->has('position') ? ' has-error' : "" }}">
                    position : <input type="text" value="{{$user_delivery->position}}" class="form-control" name="position" placeholder="Enter You position">
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : "" }}">
                    email : <input type="email" value="{{$user_delivery->email}}" class="form-control" name="email" placeholder="Enter You email">
                </div>
                <div class="form-group">
                    company delivery :  <select id="company_delivery_id" type="company_delivery_id" class="form-control" name="company_delivery_id"  >
                        @foreach($company_delivery as $key => $mycompany_delivery)
                            <option value="{{$key}}"  @if($user_delivery->company_delivery_id == $key)){ selected  } @else{   }@endif  > {{$mycompany_delivery}}</option>
                        @endforeach
                    </select>
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