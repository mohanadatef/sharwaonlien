@extends('includes.frontend.master_frontend')
@section('title')
    Profile
@endsection
@section('content')
    <section id="profile-body-section">

        <div align="center">
            <br> <br>
            <h1>Account Overview</h1>
            <hr>
            <br> <br>
<h5>
    @include('includes.admin.error')
    <form action="{{url('/profile/edit')}}" method="POST" class="book-form-content needs-validation"
          novalidate>
        {{csrf_field()}}
        {{ method_field('PATCH') }}
        <div class="book-form">

            <!-- Name section -->
            <div class="form-group {{ $errors->has('username') ? ' has-error' : "" }}">
                <label class="book-form-label" for="name">Full Name
                </label>
                <input type="text" required value="{{$user->username}}"
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
                       class="form-control book-form-input" id="inputEmail" required>
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

            <div class="form-group {{ $errors->has('address') ? ' has-error' : "" }}">
                <label for="inputPhone"
                       class="book-form-label">Address</label>
                <input type="text" value="{{$customer->address}}" name="address"
                       class="form-control book-form-input" id="inputPhone" required>
                <div class="invalid-feedback">
                    Address
                </div>
            </div>
            <!-- data-target="#exampleModalCenter" -->
            <button type="submit" data-toggle="modal" id="bookbtnId"
                    class="btn btn-primary btn-lg btn-block book-btn-lg">Ok</button>
        </div>
    </form>
</h5>
        </div>
        <br> <br> <br>
    </section>
@endsection
@section('script-1')
    <script>
        selectItem("profile");
    </script>
@endsection