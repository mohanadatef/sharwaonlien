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
        <h1 align="center">Sales Report</h1>
        <form action="{{url('admin/report/select_time/sales')}}" method="get">
            start: <input type="date" name="start">
            end: <input type="date" name="end">
            <input type="submit">
        </form>

    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>