@extends('includes.frontend.master_frontend')
@section('title')
    Sign Up
@endsection
@section('content')
    @include('includes.admin.error')
    <section id="sign-up-body-section">
        <div class="login-form-background">
            <div class="container">
                <br>
                <br>
<div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6" >
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div align="center">
                            <img src="{{url('public/images/Untitled-18.png')}}" />
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                           class="form-control @error('email') is-invalid @enderror" name="identity"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div align="center">
                                <div align="center">
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Login') }}
                                    </button>
                                    <br>
                                    <br>

                                </div>
                                <p>Create your customer account in just a few clicks! You can register either using your e-mail address</p>
                                <a href="{{ url('/register') }}">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
</div>
            </div>
        </div>
    </section>
@endsection
@section('script-1')
    <script>
        selectItem("sign_up");
    </script>
@endsection