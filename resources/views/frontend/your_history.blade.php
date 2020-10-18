@extends('includes.frontend.master_frontend')
@section('title')
    Your History
@endsection
@section('content')
    <section id="your-history-body-section">
        <section id="service-part1">
            <div class="container">
                <!-- Card place -->
                @if(count($order)>0)
                    <br>
                    <div class="card feature-card" style="width: 18rem;">
                        <div class="card1-img-top">
                            <div class="row">
                                <div class="col-md-6">
                                    {{--    <img src="{{url('public/images/50237-[Converted].png')}}" class="card1-img-top"
                                             alt="...">--}}
                                </div>
                                <div class="col-md-6">
                                    @foreach($order as $myorder)
                                    <div class="card-body">
                                        <h5 class="card-title">Order number : {{$myorder->id}}</h5>
                                        <h5 class="card-title">Count Item : {{$myorder->count_item_order}}</h5>
                                        <h5 class="card-title">Total : {{$myorder->total_cost}}</h5>
                                        @if($myorder->statues == 1)
                                            <h5 class="card-title">Status : perpar</h5>
                                        @elseif($myorder->statues == 2)
                                            <h5 class="card-title">Status : ready to go</h5>
                                        @elseif($myorder->statues == 4)
                                            <h5 class="card-title">Status : wiht delivery company</h5>
                                        @elseif($myorder->statues == 5)
                                            <h5 class="card-title">Status : with you</h5>
                                        @elseif($myorder->statues == 6 || $myorder->statues == 10)
                                            <h5 class="card-title">Status : Finish</h5>
                                        @elseif($myorder->statues == 9)
                                            <h5 class="card-title">Status : you cansaled it</h5>
                                        @else
                                            <h5 class="card-title">Status : </h5>
                                        @endif
                                    </div>
                                        @endforeach
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <br>
                @else
                    <p>WE Sorry !, But You Not Make Any Order Before<br>Last Go! to Shopping</p>
                @endif
            </div>
        </section>
    </section>
@endsection
@section('script-1')
    <script>
        selectItem("your_history");
    </script>
@endsection