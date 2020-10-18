@extends('includes.frontend.master_frontend')
@section('title')
    Finish
@endsection
@section('content')


    <section id="register-content-section">
        <div class="book-form-background">
            <div class="container">

                <div class="row" style="margin: 0 !important">
                    <div class="col-md-6">
                        <h2 class="book-head-title">Fill out a form To Finish Your Order</h2>

                        <img src="{{url('public/images/Untitled-1.png')}}" class="book-img-size"/>
                    </div>
                    <div class="col-md-6">
                        @include('includes.admin.error')
                        <form id="Finish" action="{{url('/finish/create')}}" method="POST" class="book-form-content needs-validation"
                              novalidate>
                            {{csrf_field()}}
                            <div class="book-form">

                                <!-- Name section -->
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : "" }}">
                                    <label class="book-form-label" for="name">Full Name
                                    </label>
                                    <input type="text"  value="{{$user->username}}"
                                           name="name" class="form-control book-form-input" id="name">
                                    <div class="invalid-feedback">
                                        Full Name
                                    </div>
                                </div>
                                <!-- Email section -->
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : "" }}">
                                    <label for="inputEmail"
                                           class="book-form-label"> Email</label>
                                    <input type="text" value="{{$user->email}}" name="email"
                                           class="form-control book-form-input" id="inputEmail" >
                                    <div class="invalid-feedback">
                                        email
                                    </div>
                                </div>
                                <!-- country & phone section -->

                                    <div class="form-group {{ $errors->has('mobile') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Mobile</label>
                                        <input type="text" value="{{$customer->mobile}}" name="mobile"
                                               class="form-control book-form-input" id="inputPhone" required>
                                        <div class="invalid-feedback">
                                            Mobile
                                        </div>
                                    </div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? ' has-error' : "" }}">
            <label for="inputPhone"
                   class="book-form-label">Apartment</label>
            <input type="text" value="{{$customer->Apartment}}" name="Apartment"
                   class="form-control book-form-input" id="inputPhone" required>
            <div class="invalid-feedback">
                Address
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('address') ? ' has-error' : "" }}">
            <label for="inputPhone"
                   class="book-form-label">building number</label>
            <input type="text" value="{{$customer->building}}" name="building"
                   class="form-control book-form-input" id="inputPhone" required>
            <div class="invalid-feedback">
                Address
            </div>
        </div>
    </div>
</div>
                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Address</label>
                                        <input type="text" value="{{$customer->address}}" name="address"
                                               class="form-control book-form-input" id="inputPhone" required>
                                        <div class="invalid-feedback">
                                            Address
                                        </div>
                                    </div>
                                <div class="form-group {{ $errors->has('notes') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Notes</label>
                                        <input type="text" value="{{Request::old('notes')}}" name="notes"
                                               class="form-control book-form-input" id="inputPhone" >
                                        <div class="invalid-feedback">
                                            Notes
                                        </div>
                                    </div>
                                <!-- data-target="#exampleModalCenter" -->
                                <button type="submit" data-toggle="modal" id="bookbtnId"
                                        class="btn btn-primary btn-lg btn-block book-btn-lg">Finish</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script-1')
    <script>
        selectItem("finish");
    </script>
   {{-- {!! JsValidator::formRequest('App\Http\Requests\frontend\Finish_Request','#Finish') !!}--}}
@endsection