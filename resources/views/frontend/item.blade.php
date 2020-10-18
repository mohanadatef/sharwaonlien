@extends('includes.frontend.master_frontend')
@section('title')
    Item
@endsection
@section('content')
    <section id="service-body-section">
        @include('includes.admin.error')
        <section id="service-part1">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                    size : <select id="size_filter" name="size_filter"  onchange="filter()" type="size_filter" class="form-control">
                        <option value="0" selected >all</option>
                        @foreach($size as $key => $mybag)
                            <option value="{{$key}}"> {{$mybag}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-3">
                        type : <select id="type_filter" name="type_filter"  onchange="filter()" type="type_filter" class="form-control">
                            <option value="0" selected >all</option>
                            @foreach($type as $key => $mybag)
                                <option value="{{$key}}"> {{$mybag}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        color : <select id="color_filter" name="color_filter" onchange="filter()"  type="color_filter" class="form-control">
                            <option value="0" selected >all</option>
                            @foreach($color as $key => $mybag)
                                <option value="{{$key}}"> {{$mybag}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        description : <select id="category_type_filter" name="category_type_filter" onchange="filter()"  type="category_type_filter" class="form-control">
                            <option value="0" selected >all</option>
                            @foreach($category_type as $key => $mybag)
                                <option value="{{$key}}"> {{$mybag}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="all_item" id="all_item">
                <!-- Card place -->
                @if(count($item)>0)
                @foreach($item as $myitem)
                        <div class="card mb-3 service-block1">
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
                                          {{--  gender : {{$myitem->gender->name}}
                                            <br>--}}
                                            color :  {{$myitem->color->name}}
                                            <br>
                                            type :   {{$myitem->type->name}}
                                            <br>
                                            description :  {{$myitem->category_type->name}}
                                            <br>
                                            height : {{$myitem->height_item}} / width : {{$myitem->width_item}}
                                            <br>
                                            price : {{$myitem->price}}
                                            <br>

                                           {{-- <a href="{{url('/select/'.$myitem->id)}}">
                                                <button type="button"
                                                        class="btn btn-primary btn-lg home-book-btn">Select</button>
                                            </a>--}}

                                                <form   action="{{ url('/set_cart') }}" class="lang-link" method="post" data-width="fit">
                                                    {{csrf_field()}}
                                                    <button  name="select_item" value="{{$myitem->id}}" type="submit" style="color:#f8b6af" class="lang-link">Select</button>
                                                </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
                <div align="center" >
                {{ $item->links() }}
                </div>
                @else
                    <p>WE Sorry !, But Not Have Some Thing To Show For You Now</p>
                @endif
                </div>
            </div>
        </section>
    </section>
    <section id="register-modal-message">
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <h2 class="book-modal-title "><span class="book-modal-title-span">Success!</span></h2>
                        <h2 class="book-modal-span"><i class="fas fa-check-circle"></i></h2>
                        <p class="book-modal-mes-detail">Thanks for choose the item</p>
                    </div>
                    <div class="modal-footer" style="justify-content: center;border: none;">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                        <button type="button" class="btn btn-primary"
                                style="min-width: 100px;background: #00adef;border:none;"
                                data-dismiss="modal">Stay To Shop</button>
                        <a id="cart" href="{{ url('/cart') }}" onclick="selectItem('cart')"
                           class="btn btn-primary">Go To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script-1')
    <script>
        function filter() {
            var size = document.getElementById("size_filter").value;
            var color = document.getElementById("color_filter").value;
            var category_type = document.getElementById("category_type_filter").value;
            var type = document.getElementById("type_filter").value;
            console.log(size,color,category_type,type);
            $.ajax({
                type: "GET",
                url: "{{url('get-item-filter')}}",
                data: {
                    'size': size,
                    'color': color,
                    'category_type': category_type,
                    'type': type,
                },
                success: function(data){
                    $('#all_item').empty();
                    if(data.length > 0)
                    {
                    for ($i = 0; $i < data.length; $i++) {
                        $("#all_item").append(
                            ' <div class="card mb-3 service-block1">'
                            + '<div class="row no-gutters" style="margin: 0 !important">'
                            + '<div class="col-md-6">'
                            + '<img src="public/images/item/'+data[$i].image_main+'" class="card-img service-block1-img" alt="...">'
                            + '</div>'
                            + '<div class="col-md-6">'
                            + '<div class="card-body">'
                            + '<h2 class="card-title service-block1-title">' +data[$i].code+'</h2>'
                            + '<div class="card-text service-block1-prag">'
                            + 'size : '+data[$i].size_id+'<br>'
                            + 'color : ' +data[$i].color_id+ '<br>'
                            + 'type :   ' +data[$i].type_id+ '<br>'
                            + 'description :'+ +data[$i].category_type_id + '<br>'
                            + 'height : ' +data[$i].height_item +'/ width : ' +data[$i].width_item +'<br>'
                            + 'price : ' +data[$i].price + '<br>'
                            + '<form   action="{{ url('/set_cart') }}" class="lang-link" method="post" data-width="fit">'
                            + '{{csrf_field()}}'
                            + '<button  name="select_item" value="'+data[$i].id+ '" type="submit" style="color:#f8b6af" class="lang-link">Select</button>'
                            + '</form>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                       );
                    }

                    }
                    else
                    {
                        $("#all_item").append( '<p>WE Sorry !, But Not Have Some Thing To Show For You Now</p>');
                    }
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        }
    </script>
@if($check > 0)
    <script>
        $(document).ready(function () {
            $('#exampleModalCenter').modal('show');
        });
    </script>
@endif
@endsection