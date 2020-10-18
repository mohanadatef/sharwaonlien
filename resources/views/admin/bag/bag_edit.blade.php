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
            <form action="{{url('admin/bag/edit/'.$bag->id)}}"  method="POST">
                {{csrf_field()}}
                {{method_field('patch')}}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : "" }}">
                        Bag # : <input type="text" disabled value="{{$bag->name}}" class="form-control" name="name" placeholder="Enter You name">
                    </div>
                <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : "" }}">
                    Supplier : <select id="supplier_id" type="supplier_id" class="form-control" name="supplier_id" >
                        <option value="" selected disabled>Select user</option>
                        @foreach($supplier as $key => $mysupplier)
                            <option value="{{$key}}"  @if($bag->supplier_id == $key)){ selected  } @else{   }@endif  > {{$mysupplier}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    Purchased by :  <select id="user_buy_id" name="user_buy_id" type="user_buy_id" class="form-control"  >
                        <option value="" selected disabled>Select user</option>
                        @foreach($user as $user_role)
                            @foreach($user_role->role as $role)
                                @if($role->name =='owner' || $role->name =='sales bag')
                                    <option value="{{$user_role->id}}" @if($bag->user_buy_id == $user_role->id)){ selected  } @else{   }@endif> {{$user_role->username}}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="form-group{{ $errors->has('weight') ? ' has-error' : "" }}">
                    Weight : <input type="text" value="{{$bag->weight}}" class="form-control" name="weight" placeholder="Enter You weight">
                </div>
                @if($bag->statues ==1)
                    <div class="form-group{{ $errors->has('statues') ? ' has-error' : "" }}">
                        Statues : <input type="text" disabled value="Active" class="form-control" name="statues" >
                    </div>
                @elseif($bag->statues ==0)
                    <div class="form-group{{ $errors->has('statues') ? ' has-error' : "" }}">
                        Statues : <input type="text" disabled value="Dactive" class="form-control" name="statues" >
                    </div>
                @endif
                @if($bag->cost_buy==0)
                    <div class="form-group{{ $errors->has('cost_buy') ? ' has-error' : "" }}">
                        Cost : <input type="text" value="" class="form-control" name="cost_buy" placeholder="Enter You cost buy">
                    </div>
                @else
                    <div class="form-group{{ $errors->has('cost_buy') ? ' has-error' : "" }}">
                        Cost : <input type="text" value="{{$bag->cost_buy}}" class="form-control" name="cost_buy" placeholder="Enter You cost buy">
                    </div>
                @endif
                @if($bag->cost_profit==0)
                    <div class="form-group{{ $errors->has('cost_profit') ? ' has-error' : "" }}">
                        Price : <input type="text" value="" class="form-control" name="cost_profit" placeholder="Enter You cost profit">
                    </div>
                @else
                    <div class="form-group{{ $errors->has('cost_profit') ? ' has-error' : "" }}">
                        Price : <input type="text" value="{{$bag->cost_profit}}" class="form-control" name="cost_profit" placeholder="Enter You cost profit">
                    </div>
                @endif
                @if($bag->cost_buy != 0 || $bag->cost_profit != 0)
                    <div class="form-group">
                        Number Of Items : <input type="text" disabled value="{{$bag->count_item }}" class="form-control">
                    </div>
                    @if($bag->count_item  != 0)
                        <div class="form-group">
                            Average Cost : <input type="text" disabled value="{{$bag->cost_buy / $bag->count_item }}" class="form-control">
                        </div>
                    @else
                        <div class="form-group">
                            Average Cost : <input type="text" disabled value="0" class="form-control">
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