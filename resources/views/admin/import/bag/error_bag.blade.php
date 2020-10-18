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
        <div class="page-content">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">import sheet</h1>
                    </div>
                    <div class="col-md-1">
                        <a href="{{  url('/admin/import/bag') }}" class="btn btn-sm btn-primary">import</a>
                        <a href="{{  url('/admin/import/error/bag') }}" class="btn btn-sm btn-primary">test</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div align="center" class="col-md-12 table-responsive">
                        <table id="example1" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th align="center">name</th>
                                <th align="center">supplier</th>
                                <th align="center">user buy</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="center">
                                    @foreach($bagname as $name)
                                        <li>{{ $name}}</li>
                                    @endforeach
                                </td>
                                <td class="center">
                                    @foreach($suppliername as $name)
                                        <li>{{ $name}}</li>
                                    @endforeach
                                </td>
                                <td class="center">
                                    @foreach($username as $name)
                                        <li>{{ $name}}</li>
                                    @endforeach
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>