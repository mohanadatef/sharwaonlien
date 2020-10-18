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
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-11">
                        <h1 align="center">Contact US</h1>
                    </div>
                    @permission('contact-us-create')
                    @if($contactus->count() == 0)
                        <div class="col-md-1">
                            <a href="{{  url('/admin/contact_us/create') }}" class="btn btn-sm btn-primary">Add</a>
                        </div>
                    @endif
                    <br>
                    @endpermission
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($contactus) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">address</th>
                                    <th class="center">email</th>
                                    <th class="center">latitude</th>
                                    <th class="center">longitude</th>
                                    <th class="center">phone</th>
                                    <th class="center">Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contactus as $contact)
                                    <tr>
                                        <td class="center">{{ $contact->address }}</td>
                                        <td class="center">{{ $contact->email }}</td>
                                        <td class="center">{{ $contact->latitude }}</td>
                                        <td class="center">{{ $contact->longitude }}</td>
                                        <td class="center">{{ $contact->phone }}</td>
                                        <td class="center">
                                            @permission('contact-us-edit')
                                            <a href="{{ url('/admin/contact_us/edit/'.$contact->id)}}"><i class="ace-icon fa fa-edit bigger-120  edit" data-id=""></i></a>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Data to show</div>
                    @endif
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