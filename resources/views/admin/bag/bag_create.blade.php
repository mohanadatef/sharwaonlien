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
            <form action="{{url('admin/bag/create')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                    Bag # : <input type="text" disabled value="{{'bag'.$id}}" class="form-control" name="name"
                                  placeholder="Enter You name">
                </div>
                <div class="form-group">
                    supplier : <select id="supplier_id" name="supplier_id" type="supplier_id" class="form-control">
                        <option value="" selected disabled>Select supplier</option>
                        @foreach($supplier as $key => $mysupplier)
                            <option value="{{$key}}"> {{$mysupplier}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    Purchased by : <select id="user_buy_id" name="user_buy_id" type="user_buy_id" class="form-control">
                        <option value="" selected disabled>Select user</option>
                        @foreach($user as $user_role)
                            @foreach($user_role->role as $role)
                                @if($role->name =='owner' || $role->name =='sales bag')
                                    <option value="{{$user_role->id}}"> {{$user_role->username}}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group{{ $errors->has('weight') ? ' has-error' : "" }}">
                    Weight : <input type="text" value="{{Request::old('weight')}}" class="form-control" name="weight"
                                    placeholder="Enter You weight">
                </div>
                    <div class="form-group{{ $errors->has('cost_buy') ? ' has-error' : "" }}">
                        Cost : <input type="text" value="{{Request::old('cost_buy')}}" class="form-control" name="cost_buy" placeholder="Enter You cost buy">
                    </div>
                    <div class="form-group{{ $errors->has('cost_profit') ? ' has-error' : "" }}">
                        Price : <input type="text" value="{{Request::old('cost_profit')}}" class="form-control" name="cost_profit" placeholder="Enter You cost profit">
                    </div>
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