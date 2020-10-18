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
                        <h1 align="center">Item need go to store</h1>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($item) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">code</th>
                                    <th class="center">brand</th>
                                    <th class="center">size</th>
                                    <th class="center">color</th>
                                    <th class="center">bag</th>
                                    <th class="center">Image</th>
                                    @permission('item-insert')
                                    <th class="center">Control</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item as $myitem)
                                    <tr>
                                        <td class="center">{{ $myitem->code}}</td>
                                        <td class="center">{{ $myitem->brand->name}}</td>
                                        <td class="center">{{ $myitem->size->name}}</td>
                                        <td class="center">{{ $myitem->color->name}}</td>
                                        <td class="center">{{ $myitem->bag->name}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->image_main ) }}" style="width:100px;height: 100px"></td>
                                        @permission('location-insert')
                                        <td class="center">
                                            <a href="{{ url('/admin/item/location/'.$myitem->id)}}"><i class=" fa fa-insert" >choose location</i></a>
                                        </td>
                                        @endpermission
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no Item to show</div>
                    @endif
                </div>
            </div>
</div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>