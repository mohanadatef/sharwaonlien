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
            <div align="center"><h3>{{ __('Supplier Informations') }}</h3></div>
                    name : <input type="text" disabled value="{{$supplier->name}}" class="form-control">
                    address : <input type="text" disabled value="{{$supplier->address}}" class="form-control" >
                    number : <input type="text" disabled value="{{$supplier->mobile}}" class="form-control" >
                email : <input type="text" disabled value="{{$supplier->email}}" class="form-control" >
            @if($supplier->statues == 1 )
                statues : <input type="text" disabled value="active" class="form-control">
            @else
                statues : <input type="text" disabled value="dactive" class="form-control">
            @endif
            </div>
        <br>
                <div align="center">
                    <a href="{{url('/admin/supplier')}}" class="btn btn-sm btn-primary">back</a>
                </div>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>