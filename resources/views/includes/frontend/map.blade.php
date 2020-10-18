<div class="col-md-6 maps find-map">

    <div id="googleMap" style="
                                                height: 430px;
                                            position: relative;
                                            overflow: hidden;
                                            text-align: center;box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
                                            margin: auto;"></div>

    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng('{{$contact_us->latitude}}', '{{$contact_us->longitude}}'),
                zoom: 18,
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        }
    </script>

    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbCC290lsRmFqh6-Udf7urHWq7TjFnvNY&callback=myMap"></script>

</div>
@yield('map')
