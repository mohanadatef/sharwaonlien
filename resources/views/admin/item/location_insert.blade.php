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
        <div align="center"><h3>{{ __('Location List') }}</h3></div>
        <div style="margin-right: 30px;margin-left: 30px">
            <div class="row">
                @foreach($location as $mylocation)
                    <div class="col-md-3">
                        <h5>name : {{$mylocation->name}}</h5>
                        @if($mylocation->space != $mylocation->count_item)
                            <h5>space :{{$mylocation->space-$mylocation->count_item}}</h5>
                            @permission('item-insert')
                            <div class="center">
                                <a href="{{ url('/admin/item/insert/'.$item->id.'/'.$mylocation->id)}}" class="btn btn-sm btn-primary"><i class=" fa fa-insert" >insert</i></a>
                            </div>
                            @endpermission
                        @else
                            <h5>no space</h5>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>