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
        <div class="col-md-12">
            <br>
            <div align="center"><h3>{{ __('Bag') }}</h3></div>
            <form action="{{url('admin/manage_bag/edit/'.$manage_bag->id)}}"  method="POST">
                {{csrf_field()}}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                        name : <input type="text" disabled value="{{$manage_bag->name}}" class="form-control" name="name" placeholder="Enter You name">
                    </div>
                @if($manage_bag->cost_buy==0)
                <div class="form-group{{ $errors->has('cost_buy') ? ' has-error' : "" }}">
                    cost buy : <input type="text" value="" class="form-control" name="cost_buy" placeholder="Enter You cost buy">
                </div>
                @else
                    <div class="form-group{{ $errors->has('cost_buy') ? ' has-error' : "" }}">
                        cost buy : <input type="text" value="{{$manage_bag->cost_buy}}" class="form-control" name="cost_buy" placeholder="Enter You cost buy">
                    </div>
                    @endif
                @if($manage_bag->cost_profit==0)
                    <div class="form-group{{ $errors->has('cost_profit') ? ' has-error' : "" }}">
                        cost profit : <input type="text" value="" class="form-control" name="cost_profit" placeholder="Enter You cost profit">
                    </div>
                @else
                    <div class="form-group{{ $errors->has('cost_profit') ? ' has-error' : "" }}">
                        cost profit : <input type="text" value="{{$manage_bag->cost_profit}}" class="form-control" name="cost_profit" placeholder="Enter You cost profit">
                    </div>
                @endif
                @if($manage_bag->cost_buy != 0 || $manage_bag->cost_profit != 0)
                    <div class="form-group">
                        count item : <input type="text" disabled value="{{$manage_bag->count_item }}" class="form-control">
                    </div>
                    @if($manage_bag->count_item  != 0)
                    <div class="form-group">
                        Averag cost : <input type="text" disabled value="{{$manage_bag->cost_buy / $manage_bag->count_item }}" class="form-control">
                    </div>
                        @else
                        <div class="form-group">
                            Averag cost : <input type="text" disabled value="0" class="form-control">
                        </div>
                        @endif
                @endif
                <div align="center">
                    <input type="submit" class="btn btn-primary" value="Done">
                </div>
            </form>
        </div>
    </div>
    @include('includes.admin.footer')
    @include('includes.admin.scripts')
</div>
</body>
</html>