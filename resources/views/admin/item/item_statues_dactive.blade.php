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
                        <h1 align="center">statues Dactive Item</h1>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($item) > 0)
                        <form method="get" action="{{ url('/admin/item/statues/all')}}">
                        @permission('item-statues-change')

                            <input type="submit" value="Change Status" class="btn btn-primary" >

                            @endpermission
                        <div align="center" class="col-md-12 table-responsive">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    @permission('item-statues-change')
                                    <th class="center">#</th>
                                    @endpermission
                                    <th class="center">code</th>
                                    <th class="center">Image</th>
                                    @permission('item-statues-change')
                                    <th class="center">statues</th>
                                    @endpermission
                                    @permission('item-cost-create')
                                    <th class="center">price</th>
                                    @endpermission
                                    <th class="center">Control</th>
                                    @permission('item-discount')
                                    <th class="center">discount</th>
                                    @endpermission
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item as $myitem)
                                    <tr>
                                        <td class="center">

                                            <input type="checkbox" name="service[]" id="{{$myitem->id}}" value="{{$myitem->id}}">
                                        </td>
                                        <td class="center">{{ $myitem->code}}</td>
                                        <td class="center"><img src="{{ asset('public/images/item/' . $myitem->image_main ) }}" style="width:100px;height: 100px"></td>
                                        @permission('item-statues-change')
                                        <td class="center"><h7>Dactive     </h7><a href="{{ url('/admin/item/statues/'.$myitem->id)}}"><i class="ace-icon fa fa-close"></i></a></td>
                                        @endpermission
                                        <td class="center">{{ $myitem->price    }}</td>
                                        @permission('item-cost')
                                        <td class="center">
                                            <a href="{{ url('/admin/item/cost/create/'.$myitem->id)}}"><i class=" fa fa-money" >pricing</i></a>
                                        </td>
                                        @endpermission
                                        <td class="center">
                                            @permission('item-discount')
                                            <button type="button" id="{{$myitem->id}}"
                                                    onclick="selectItem('{{$myitem->id}}','{{$myitem->discount}}')"
                                                    class="btn btn-sm btn-primary ace-icon fa fa-edit bigger-120  edit"
                                                    data-toggle="modal"
                                                    data-target="#modal-edit">
                                                Edit
                                            </button>
                                            @endpermission
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $item->links() }}
                        </div>
                        </form>
                    @else
                        <div class="empty" align="center">There is no Item to show</div>
                    @endif
                </div>
        </div>
    </div>
    @if(count($item) != null)
        <div class="modal modal-info fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>

                        <section class="content-header">
                            <h1>
                                Discount
                            </h1>
                        </section>
                    </div>
                    <form id="size_edit" action="" method="POST">
                        <div class="modal-body">
                            <h3 align="center">Discount</h3>
                            <section class="content">
                                {{csrf_field()}}
                                <div class="form-group{{ $errors->has('order') ? ' has-error' : "" }}">
                                    discount : <input type="text" value="{{$myitem->discount}}" class="form-control" name="discount" id="discount" placeholder="Enter You discount">
                                </div>
                            </section>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline">Done</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endif
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
    <script>
        function selectItem(id, discount) {
            $('#size_edit').attr('action', "discount/" + id);
            $('#discount').val(discount);
        }
    </script>
</div>
</body>
</html>