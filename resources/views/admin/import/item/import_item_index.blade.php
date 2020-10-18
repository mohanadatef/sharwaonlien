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
                        <a href="{{  url('/admin/import/item') }}" class="btn btn-sm btn-primary">import</a>
                        <a href="{{  url('/admin/import/error/item') }}" class="btn btn-sm btn-primary">test</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($templet_item) > 0)
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th class="center">bag</th>
                                    <th class="center">brand</th>
                                    <th class="center">size</th>
                                    <th class="center">type</th>
                                    <th class="center">category type</th>
                                    <th class="center">color</th>
                  {{--                  <th class="center">gender</th>--}}
                                    <th class="center">weigth</th>
                                    <th class="center">height</th>
                                    <th class="center">width</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; ?>
                                @foreach($templet_item as $templet)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td class="center">{{ $templet->bag }}</td>
                                        <td class="center">{{ $templet->brand }}</td>
                                        <td class="center">{{ $templet->size }}</td>
                                        <td class="center">{{ $templet->type }}</td>
                                        <td class="center">{{ $templet->category_type }}</td>
                                        <td class="center">{{ $templet->color }}</td>
                                  {{--      <td class="center">{{ $templet->gender }}</td>--}}
                                        <td class="center">{{ $templet->weight }}</td>
                                        <td class="center">{{ $templet->height_item }}</td>
                                        <td class="center">{{ $templet->width_item }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty" align="center">There is no data to show</div>
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