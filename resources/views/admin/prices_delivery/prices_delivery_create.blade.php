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
            <div align="center">{{ __('Add Prices Deliver') }}</div>
            <form action="{{url('admin/prices_delivery/create')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                   city : <select id="company_delivery_id" name="company_delivery_id" type="company_delivery_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($company_delivery as $key => $mycompany_delivery)
                            <option value="{{$key}}"> {{$mycompany_delivery}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    city : <select id="city_id" name="city_id" type="city_id" class="form-control"  >
                        <option value="" selected disabled>Select</option>
                        @foreach($city as $key => $mycity)
                            <option value="{{$key}}"> {{$mycity}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    area : <select id="area_id"
                            name="area_id"
                            class="form-control selection">
                        <option value="0" selected>select area</option>
                    </select>
                </div>
                <div class="form-group{{ $errors->has('prices') ? ' has-error' : "" }}">
                    prices : <input type="text" value="{{Request::old('prices')}}" class="form-control" name="prices" placeholder="Enter You prices">
                </div>
                <input type="submit" class="btn btn-primary" value="Done ">
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