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
                        <h1 align="center">Job Reuest</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($job_request) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">job tittel</th>
                                    <th class="center">first name</th>
                                    <th class="center">last name</th>
                                    <th class="center">email</th>
                                    <th class="center">mobile</th>
                                    <th class="center">gender</th>
                                    <th class="center">birth date</th>
                                    <th class="center">university</th>
                                    <th class="center">faculty</th>
                                    <th class="center">year</th>
                                    <th class="center">grade</th>
                                    <th class="center">message</th>
                                    @permission('job-request-cv')
                                    <th class="center">resume</th>
                                    @endpermission
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($job_request as $jobrequest)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        @if($jobrequest->job_id ==null)
                                            <td class="center">بدون وظيفه</td>
                                        @else
                                        <td class="center">{{ $jobrequest->job->tittel }}</td>
                                        @endif
                                        <td class="center">{{ $jobrequest->first_name }}</td>
                                        <td class="center">{{ $jobrequest->last_name }}</td>
                                        <td class="center">{{ $jobrequest->email }}</td>
                                        <td class="center">{{ $jobrequest->mobile }}</td>
                                        <td class="center">{{ $jobrequest->gender }}</td>
                                        <td class="center">{{ $jobrequest->birth_date }}</td>
                                        <td class="center">{{ $jobrequest->university }}</td>
                                        <td class="center">{{ $jobrequest->faculty }}</td>
                                        <td class="center">{{ $jobrequest->year }}</td>
                                        <td class="center">{{ $jobrequest->grade }}</td>
                                        <td class="center">{{ $jobrequest->message }}</td>
                                        @permission('job-request-cv')
                                        <td ><a href="{{url('public/files/resume',$jobrequest->resume )}}"><i class="fa fa-download"></i> download</a> </td>
                                        @endpermission
                                        <td class="center">
                                            @permission('job-request-delete')
                                            <a href="{{url('admin/job_request/delete/'.$jobrequest->id)}}" onclick="return confirm('Are you sure?')"> <i class="ace-icon fa fa-trash bigger-120 "></i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no job request to show</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>