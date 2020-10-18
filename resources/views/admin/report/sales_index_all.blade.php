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
        <br>
        <div class="col-md-12">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
    @include('includes.admin.footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    @include('includes.admin.scripts')
    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Sales'
            },

            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,

                    }
                }
            },

            tooltip: {

                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}<br/>'
            },
            series: [
                {

                    colorByPoint: true,
                    data: [
                        {
                            name: "sales",
                            y: {{$sales}}
                        },
                        {
                            name: "cost",
                            y: {{$cost}}
                        },
                        {
                            name: "net",
                            y: {{$net}}
                        },
                    ]
                }
            ],
        });
    </script>
</div>
</body>
</html>