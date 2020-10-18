
<section id="header">

    <div id="head1Id" class="header-part1">
        <a href="{{ url('') }}">
            <img class="img-logo" src="{{ asset('public/images/setting/' . $setting->image ) }}">
        </a>

        <div class="social-icons">

            <a href="http://{{$setting->facebook}}" style="text-decoration: none;color: inherit;">   <span class="icon-pad header-icon-face   "><i class="fab fa-facebook-f"></i></span> </a>
            <a href="http://{{$setting->instagram}}" style="text-decoration: none;color: inherit;">  <span class="icon-pad header-icon-instagram"><i class="fab fa-instagram"></i></span>  </a>
            <span class="break-icon icon-pad">|</span>
            <form  autocomplete="off" action="{{ url('/item1') }}" class="lang-link" method="post" data-width="fit">
                {{csrf_field()}}
                <div  style="width:150px;" class="autocomplete">
                    <input  class="form-control" id="myInput" name="name" type="text" value="{{Request::old('name')}}" placeholder="search">
                </div>
                <input type="submit" value="search">
            </form>
        </div>
    </div>
    @include('includes.frontend.navbar')
 {{--   @include('includes.frontend.navbar_1')--}}
</section>