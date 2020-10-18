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
            <div align="center">{{ __('Edit company delivery') }}</div>
            <form action="{{url('admin/company_delivery/edit/'.$company_delivery->id)}}"  method="POST">
                {{csrf_field()}}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                        name : <input type="text" value="{{$company_delivery->name}}" class="form-control" name="name" placeholder="Enter You name">
                    </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : "" }}">
                    modile : <input type="text" value="{{$company_delivery->mobile}}" class="form-control" name="mobile" placeholder="Enter You modile">
                </div>
                <div class="form-group{{ $errors->has('address') ? ' has-error' : "" }}">
                    address : <input type="text" value="{{$company_delivery->address}}" class="form-control" name="address" placeholder="Enter You address">
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : "" }}">
                    email : <input type="text" value="{{$company_delivery->email}}" class="form-control" name="email" placeholder="Enter You email">
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : "" }}">
                    description : <textarea type="text"  class="form-control" name="description" placeholder="Enter You description">{{$company_delivery->description}}</textarea>
                </div>
                <div class="form-group{{ $errors->has('performance') ? ' has-error' : "" }}">
                    performance : <input type="text" value="{{$company_delivery->performance}}" class="form-control" name="performance" placeholder="Enter You performance">
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