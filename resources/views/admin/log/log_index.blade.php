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
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Log</h1>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($log) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">user</th>
                                    <th class="center">action status</th>
                                    <th class="center">data change</th>
                                    <th class="center">time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($log as $logs)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $logs->user->username }}</td>
                                        <td class="center">{{ $logs->action_status }}</td>
                                        <td class="center">{{ $logs->data_change }}</td>
                                        <td class="center">{{ $logs->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {{ $log->links() }}
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Log to show</div>
                    @endif
                </div>
            </div>
        </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>