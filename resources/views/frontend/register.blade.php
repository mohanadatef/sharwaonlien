@extends('includes.frontend.master_frontend')
@section('title')
    Register
@endsection
@section('content')


    <section id="register-content-section">
        <div class="book-form-background">
            <div class="container">

                <div class="row" style="margin: 0 !important">
                    <div class="col-md-6">
                        <h2 class="book-head-title">Fill out a form</h2>

                        <img src="{{url('public/images/Untitled-1.png')}}" class="book-img-size"/>
                    </div>
                    <div class="col-md-6">
                        @include('includes.admin.error')
                        <form action="{{url('/register/create')}}" method="POST" class="book-form-content needs-validation"
                              novalidate>
                            {{csrf_field()}}
                            <div class="book-form">
                                <p>If you have customer account, You can <a href="{{ url('/sign_up') }}">Sign up</a></p>

                                <!-- Name section -->
                                <div class="form-group {{ $errors->has('username') ? ' has-error' : "" }}">
                                    <label class="book-form-label" for="username">Full Name
                                    </label>
                                    <input type="text" required value="{{Request::old('username')}}"
                                           name="username" class="form-control book-form-input" id="username">
                                    <div class="invalid-feedback">
                                        Full Name
                                    </div>
                                </div>
                                <!-- Email section -->
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : "" }}">
                                    <label for="inputEmail"
                                           class="book-form-label"> Email</label>
                                    <input type="text" value="{{Request::old('email')}}" name="email"
                                           class="form-control book-form-input" id="inputEmail" required>
                                    <div class="invalid-feedback">
                                        email
                                    </div>
                                </div>
                                <!-- country & phone section -->

                                    <div class="form-group {{ $errors->has('mobile') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Mobile</label>
                                        <input type="text" value="{{Request::old('mobile')}}" name="mobile"
                                               class="form-control book-form-input" id="inputPhone" required>
                                        <div class="invalid-feedback">
                                            Mobile
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('address') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Address</label>
                                        <input type="text" value="{{Request::old('address')}}" name="address"
                                               class="form-control book-form-input" id="inputPhone" required>
                                        <div class="invalid-feedback">
                                            Address
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Password</label>
                                        <input type="password" value="{{Request::old('password')}}" name="password"
                                               class="form-control book-form-input" id="inputPhone" required>
                                        <div class="invalid-feedback">
                                            Password
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : "" }}">
                                        <label for="inputPhone"
                                               class="book-form-label">Password Confirmation</label>
                                        <input type="password" value="{{Request::old('password')}}" name="password_confirmation"
                                               class="form-control book-form-input" id="inputPhone" required>
                                        <div class="invalid-feedback">
                                            Password Confirmation
                                        </div>
                                    </div>

                                <!-- data-target="#exampleModalCenter" -->
                                <button type="submit" data-toggle="modal" id="bookbtnId"
                                        class="btn btn-primary btn-lg btn-block book-btn-lg">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
        selectItem("register");
    </script>
    @if($check > 0)
        <script>
            $(document).ready(function () {
                $('#exampleModalCenter').modal('show');
            });
        </script>
    @endif
@endsection