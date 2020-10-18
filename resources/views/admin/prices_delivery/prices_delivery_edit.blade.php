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
            <div align="center">{{ __('Edit Prices Delivery') }}</div>
            <form action="{{url('admin/prices_delivery/edit/'.$prices_delivery->id)}}"  method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    city :  <select id="company_delivery_id" type="company_delivery_id" class="form-control" name="company_delivery_id"  >
                        @foreach($company_delivery as $key => $mycompany_delivery)
                            <option value="{{$key}}"  @if($prices_delivery->company_delivery_id == $key)){ selected  } @else{   }@endif  > {{$mycompany_delivery}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                   city :  <select id="city_id" type="city_id" class="form-control" name="city_id"  >
                        @foreach($city as $key => $mycity)
                            <option value="0" selected>select city</option>
                            <option value="{{$key}}"  > {{$mycity}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                   area : <select id="area_id"  name="area_id"  class="form-control selection">
                        <option value="0" selected>select area</option>
                    </select>
                </div>
                <div class="form-group{{ $errors->has('prices') ? ' has-error' : "" }}">
                    prices : <input type="text" value="{{$prices_delivery->prices}}" class="form-control" name="prices" placeholder="Enter You prices">
                </div>
                <div align="center">
                    <input type="submit" class="btn btn-primary" value="Done">
                </div>
            </form>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
    <script type="text/javascript">
        $('#city_id').change(function () {
            var cityID = $(this).val();
            if (cityID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-Area-list')}}?city_id=" + cityID,
                    success: function (res) {
                        if (res) {
                            $("#area_id").empty();
                            $("#area_id").append('<option> select Area</option>');
                            $.each(res, function (key, value) {
                                if(value == "غير محدد")
                                {
                                }
                                else {
                                    $("#area_id").append('<option value="' + key + '">' + value + '</option>');
                                }                            });
                        } else {
                            $("#area_id").empty();
                        }
                    }
                });
            } else {
                $("#area_id").empty();
            }
        });
    </script>
</div>
</body>
</html>