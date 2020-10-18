@extends('includes.frontend.master_frontend')
@section('title')
    Cart
@endsection
@section('content')
    <section id="service-body-section">
        @include('includes.admin.error')
        <section id="service-part1">
            <div class="container">
                <!-- Card place -->
                @if($item != null)
                    <br>
                    <div class="card feature-card" style="width: 18rem;">
                        <div class="card1-img-top">
                            <div class="row">
                                <div class="col-md-6">
                                    {{--    <img src="{{url('public/images/50237-[Converted].png')}}" class="card1-img-top"
                                             alt="...">--}}
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">Count Item : {{count($item)}}</h5>
                                        <h5 class="card-title">Total : {{$total}}</h5>
                                    </div>
                                    <a href="{{url('/finish/')}}">
                                        <button type="button"
                                                class="btn btn-primary btn-lg home-book-btn"
                                                onclick="return confirm('Are you sure?')">Finish
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
                    <div class="card feature-card" style="width: 18rem;">
                        @foreach($item as $myitem)
                            <h5 class="card-title" align="center">All Item</h5>
                            <div class="row no-gutters"
                                 style="margin: 0 !important">
                                <div class="col-md-6">
                                    <img src="{{url('public/images/item/'.$myitem->image_main)}}"
                                         class="card-img service-block1-img" alt="...">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h2 class="card-title service-block1-title">{{ $myitem->code}}</h2>
                                        <div class="card-text service-block1-prag">
                                            size : {{$myitem->size->name}}
                                            <br>
                                         {{--   gender : {{$myitem->gender->name}}
                                            <br>--}}
                                            color : {{$myitem->color->name}}
                                            <br>
                                            type : {{$myitem->type->name}}
                                            <br>
                                            category : {{$myitem->category_type->name}}
                                            <br>
                                            weight : {{$myitem->weight}} / height : {{$myitem->height_item}}
                                            / width : {{$myitem->width_item}}
                                            <br>
                                            price : {{$myitem->price}}
                                            <br>
                                            <form   action="{{ url('/canasel') }}" class="lang-link" method="post" data-width="fit">
                                                {{csrf_field()}}
                                                <button  name="canasel_item" value="{{$myitem->id}}" type="submit" style="color: red" class="lang-link">canasel</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>

                @else
                    <p>WE Sorry !, But You Not Choose Some Thing<br>Last Go! to Shopping</p>
                @endif
            </div>
        </section>
    </section>
@endsection
@section('script-1')
    <script>
        selectItem("cart");
    </script>
@endsection