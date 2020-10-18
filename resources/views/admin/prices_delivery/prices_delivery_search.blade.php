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
            <h1 align="center">{{ __('search Prices Deliver') }}</h1>
            <br>
            <div class="row" id="error" style="color: red;" align="center"></div>
                <div class="form-group">
                    city : <select id="city_id"  type="city_id"  name="city_id"
                                   class="form-control selection" onchange="my_city_id('city_id')" >
                        <option value="" selected disabled>Select</option>
                        @foreach($city as $key => $mycity)
                            <option value="{{$key}}"> {{$mycity}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    area : <select id="area_id"
                            name="area_id"
                            class="form-control selection" onchange="my_area_id('area_id')">
                        <option value="0" selected>select area</option>
                    </select>
                </div>
        </div>
        <div align="center">
        <a  class="btn btn-sm btn-primary" onclick="filter()" id="done">serach</a>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                    <div align="center" class="col-md-12 table-responsive">
                        <table  class="table">
                            <thead>
                            <tr>
                                <th class="center">company delivery</th>
                                <th class="center">city</th>
                                <th class="center">area</th>
                                <th class="center">prices</th>
                                <th class="center">modile</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <div class="row" id="error" style="color: red;" align="center"></div>
                            <td class="center"><div id="map1"> </div></td>
                            <td class="center"><div id="map2"> </div></td>
                            <td class="center"><div id="map3"> </div></td>
                            <td class="center"><div id="map4"> </div></td>
                            <td class="center"><div id="map5"> </div></td>
                        </table>
                    </div>
            </div>
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
                            $("#area_id").append('<option value="0"> select Area</option>');
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
        function my_city_id(Id) {
            var city_id = document.getElementById("city_id").value;
            $('#map1').empty();
            $('#map2').empty();
            $('#map3').empty();
            $('#map4').empty();
            $('#map5').empty();
            $('#error').empty();
        }
        function my_area_id(Id) {
            var area_id = document.getElementById("area_id").value;
            $('#map1').empty();
            $('#map2').empty();
            $('#map3').empty();
            $('#map4').empty();
            $('#map5').empty();
            $('#error').empty();
        }
        function filter() {
            var city_id = $('#city_id').val();
            var area_id = $('#area_id').val();
            if (city_id == 0 || area_id == 0) {
                $('#error').empty();
                $("#error").append('<span >' + 'يجب إدخال البيانات لإتمام عملية البحث!' + '</span>');
            }
            else {
                $('#error').empty();
                $.ajax({
                    type: "GET",
                    url: "{{url('filter')}}",
                    cache: false,
                    data: {
                        'city_id': city_id,
                        'area_id': area_id,
                    },
                    success: function (data) {
                        if (data.length != 0) {
                            $('#map1').empty();
                            $('#map2').empty();
                            $('#map3').empty();
                            $('#map4').empty();
                            $('#map5').empty();
                            for ($i = 0; $i < data.length; $i++) {
                                $("#map1").append('<td class="center">' + data[$i].company_delivery.name + '</td>');
                                $("#map2").append('<td class="center">' + data[$i].city.name + '</td>');
                                $("#map3").append('<td class="center">' + data[$i].area.name + '</td>');
                                $("#map4").append('<td class="center">' + data[$i].prices + '</td>');
                                $("#map5").append('<td class="center"><a href=tel:'+data[$i].company_delivery.modile+'>' + data[$i].company_delivery.modile + '</a></td>');
                            }
                        } else {
                            $('#map1').empty();
                            $('#map2').empty();
                            $('#map3').empty();
                            $('#map4').empty();
                            $('#map5').empty();
                            $('#map1').append('<td>'+'   '+'</td>');
                            $('#map2').append('<td>'+'    '+'</td>');
                            $('#map3').append('<td>' + 'لا يوجد بيانات ' + '</td>');
                            $('#map4').append('<td>'+ '   '+'</td>');
                            $('#map5').append('<td>'+'    '+'</td>');
                        }
                    },
                });
            }
        }
    </script>
</div>
</body>
</html>