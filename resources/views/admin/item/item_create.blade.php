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
            <div align="center"><h3>{{ __('item') }}</h3></div>
            <form action="{{url('admin/item/create')}}" enctype="multipart/form-data" method="POST"
                  style="margin-right: 30px;margin-left: 30px">
                {{csrf_field()}}
                <div class="form-group">
                    bag : <select id="bag_id" name="bag_id"  onchange="price_item()" type="bag_id" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($bag as $key => $mybag)
                            <option value="{{$key}}"> {{$mybag}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    brand : <select id="brand_id" name="brand_id" type="brand_id" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($brand as $key => $mybrand)
                            <option value="{{$key}}"> {{$mybrand}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    description : <select id="category_type_id" name="category_type_id" type="category_type_id"
                                          class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($category_type as $key => $mycategory_type)
                            <option value="{{$key}}"> {{$mycategory_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    type : <select id="type_id" name="type_id" type="type_id" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($type as $key => $mytype)
                            <option value="{{$key}}"> {{$mytype}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    size : <select id="size_id" name="size_id" type="size_id" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($size as $key => $mysize)
                            <option value="{{$key}}"> {{$mysize}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    color : <select id="color_id" name="color_id" type="color_id" class="form-control">
                        <option value="" selected disabled>Select</option>
                        @foreach($color as $key => $mycolor)
                            <option value="{{$key}}"> {{$mycolor}}</option>
                        @endforeach
                    </select>
                </div>
                {{--     <div class="form-group">
                         gender : <select id="gender_id" name="gender_id" type="gender_id" class="form-control">
                             <option value="" selected disabled>Select</option>
                             @foreach($gender as $key => $mygender)
                                 <option value="{{$key}}"> {{$mygender}}</option>
                             @endforeach
                         </select>
                     </div>--}}
                <div class="form-group{{ $errors->has('weight') ? ' has-error' : "" }}">
                    weight item : <input type="text" value="{{Request::old('weight')}}" class="form-control"
                                         onchange="price_item()" id="weight" name="weight"
                                         placeholder="Enter You weight">
                </div>
                <div class="form-group{{ $errors->has('height_item') ? ' has-error' : "" }}">
                    height item : <input type="text" value="{{Request::old('height_item')}}" class="form-control"
                                         name="height_item" placeholder="Enter You height item">
                </div>
                <div class="form-group{{ $errors->has('width_item') ? ' has-error' : "" }}">
                    width item : <input type="text" value="{{Request::old('width_item')}}" class="form-control"
                                        name="width_item" placeholder="Enter You width item">
                </div>
                <div class="form-group{{ $errors->has('cost') ? ' has-error' : "" }}">
                    cost : <input type="text" id="cost"  value="" class="form-control" name="cost"
                                           placeholder="">
                </div>
                <div class="form-group{{ $errors->has('discount') ? ' has-error' : "" }}">
                    discount : <input type="text" value="{{Request::old('discount')}}" class="form-control" name="discount" placeholder="Enter You discount">
                </div>
                    <div class="form-group{{ $errors->has('minimum_price') ? ' has-error' : "" }}">
                        minimum price : <input type="text" id="minimum_price"  value="" class="form-control" name="minimum_price"
                               placeholder="">
                    </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : "" }}">
                    price : <input type="text" value="{{Request::old('price')}}" class="form-control" name="price"
                                   placeholder="Enter You price">
                </div>
                <div class="form-group{{ $errors->has('image_main') ? ' has-error' : "" }}">
                    <table class="table">
                        <tr>
                            <td width="40%" align="right"><label>Select File for Upload image main</label></td>
                            <td width="30"><input type="file" value="{{Request::old('image_main')}}" name="image_main"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"></td>
                            <td width="30"><span class="text-muted">jpg, png, gif</span></td>
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
    <script>
        function price_item() {
            var bag_id = document.getElementById("bag_id").value;
            var weight = document.getElementById("weight").value;
            $.ajax({
                type: "GET",
                url: "{{url('get-cost-bag')}}",
                data: {
                    'weight': weight,
                    'bag_id': bag_id,
                },
                success: function(data){
                    minimum_price = data['minimum_price'];
                    cost = data['cost'];
                    $('#minimum_price').val(minimum_price);
                    $('#cost').val(cost);
                },
            });
        }
    </script>
</div>
</body>
</html>