@extends('includes.frontend.master_frontend')
@section('title')
    Home
@endsection
@section('content')
    <section id="home-body-section">
        <section id="home-slider-section">
            <div id="demo" class="carousel slide vertical" data-ride="carousel">
                <ul class="carousel-indicators">
                    <?php $i = 0; ?>
                    @foreach($home_slider as $homeslider)
                        <li data-target="#demo" data-slide-to="{{$i++}}"
                            @if($myslider->id == $homeslider->id)class="active"@endif></li>
                    @endforeach
                </ul>
                <div class="carousel-inner">
                    @foreach($home_slider as $homeslider)
                        <div class="carousel-item @if($myslider->id == $homeslider->id)active @endif">
                            <img src="{{url('public/images/home_slider/'.$homeslider->image)}}" alt="Los Angeles"
                                 width="1100" height="500">
                            <div class="carousel-caption">
                                <div style="background-color: rgba(250, 250, 250, 0.4);">
                                    <p class="carousel-inner-title">{{$homeslider->title}}</p>
                                    <span class="home-carousel-span">{!! $homeslider->description !!}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </section>
    @if($item != null)
       {{-- <section id="feature-slider-section">
            <div class="feature-part">
                <h2 class="feature-head-part1"></h2>
                <div class="row" style="margin: 0 !important">
                    <div class="col-md-8">
                        <h1 class="feature-head-part2"></h1>

                    </div>
                    <div class="col-md-4 feature-head-part3">
                            <span class="arrow-icon" href="#carousel-example-multi" data-slide="prev"> <i
                                        class="fas fa-chevron-circle-left"></i> </span>
                        <span class="arrow-icon" data-slide="next" href="#carousel-example-multi"> <i
                                    class="fas fa-chevron-circle-right"></i> </span>
                    </div>
                </div>

                <section id="feature-slider-section">

                    <div id="carousel-example-multi" class="carousel slide carousel1-multi-item v-2"
                         data-ride="carousel">
                        <div class="carousel-inner v-2" role="listbox">
                            @foreach($item as $myitem)
                                <div class="carousel-item @if($item1 != null) @if($item1->id == $myitem->id )active @endif @endif">
                                    <div class="col-12 col-md-4">
                                        <div class="card mb-2">
                                            <div class="card feature-card" style="width: 18rem;">
                                                <img src="{{url('public/images/item/'.$myitem->image_main)}}" class="card-img-top"
                                                     alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$myitem->code}}</h5>
                                                    <h5 class="card-title">{{$myitem->category_type->name}}</h5>
                                                    <h5 class="card-title">{{$myitem->type->name}}</h5>
                                                    <h5 class="card-title">{{$myitem->color->name}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>
                <!-- #region slider part -->
                <!-- #endregion slider part -->
            </div>
        </section>--}}
       <section id="gallery1">

           <div class="gallery1">
               <div class="container">
                   <div class="gallery-header">
                   </div>


                   <div id="slider-gallery1"  class="carousel slide carousel-multi-item v-2"
                        data-ride="carousel">
                       <ol class="carousel-indicators carousel-indicators-multi">
                           <li data-target="#slider-gallery1" data-slide-to="0" class="active"></li>
                           <li data-target="#slider-gallery1" data-slide-to="1"></li>
                       </ol>
                       <div class="carousel-inner v-2" role="listbox">
@foreach($item as $myitem )
                           <div class="carousel-item active">
                               <div class="col-12 col-md-3">
                                   {{$myitem->code}}
                                   <div class="card mb-2">
                                       <div class="gallery-img-container hvr-grow">
                                           <img src="{{url('public/images/item/'.$myitem->image_main)}}"
                                                class="card-img-top" alt="..." style="height: 250px;width: 250px">
                                       </div>
                                   </div>
                               </div>
                           </div>
    @endforeach
                       </div>

                   </div>
               </div>
           </div>

       </section>
    @else
        <p>Not Data now</p>
    @endif
    <section id="register-modal-message">
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <h2 class="book-modal-title "><span class="book-modal-title-span">Success!</span></h2>
                        <h2 class="book-modal-span"><i class="fas fa-check-circle"></i></h2>
                        <p class="book-modal-mes-detail">Thanks for filling the form, this will help us informing you
                            by all needed information for you.
                            Thanks!</p>
                    </div>
                    <div class="modal-footer" style="justify-content: center;border: none;">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                        <button type="button" class="btn btn-primary"
                                style="min-width: 100px;background: #00adef;border:none;"
                                data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script-1')
    <script>
        selectItem("home");
    </script>
    @if($check > 0)
        <script>
            $(document).ready(function () {
                $('#exampleModalCenter').modal('show');
            });
        </script>
    @endif
@endsection