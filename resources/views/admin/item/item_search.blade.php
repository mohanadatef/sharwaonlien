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
            <div align="center"><h3>{{ __('item') }}</h3></div>
            <form action="{{url('admin/item/search/index')}}" enctype="multipart/form-data" method="POST" style="margin-right: 30px;margin-left: 30px">
                {{csrf_field()}}
                @permission('item-search-code')
                <div class="form-group{{ $errors->has('id') ? ' has-error' : "" }}">
                    id item : <input type="text" value="{{Request::old('id')}}" class="form-control" name="id" placeholder="Enter You id">
                </div>
                @endpermission
                @permission('item-search-choose')
                <div class="form-group">
                    brand : <select id="brand_id" name="brand_id" type="brand_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($brand as $key => $mybrand)
                            <option value="{{$key}}"> {{$mybrand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    description : <select id="category_type_id" name="category_type_id" type="category_type_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($category_type as $key => $mycategory_type)
                            <option value="{{$key}}"> {{$mycategory_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    type : <select id="type_id" name="type_id" type="type_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($type as $key => $mytype)
                            <option value="{{$key}}"> {{$mytype}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    size : <select id="size_id" name="size_id" type="size_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($size as $key => $mysize)
                            <option value="{{$key}}"> {{$mysize}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    color : <select id="color_id" name="color_id" type="color_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($color as $key => $mycolor)
                            <option value="{{$key}}"> {{$mycolor}}</option>
                        @endforeach
                    </select>
                </div>
               {{-- <div class="form-group">
                    gender : <select id="gender_id" name="gender_id" type="gender_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($gender as $key => $mygender)
                            <option value="{{$key}}"> {{$mygender}}</option>
                        @endforeach
                    </select>
                </div>--}}
                @endpermission
                <div align="center">
                <input type="submit" class="btn btn-primary" value="search">
                </div>
            </form>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>