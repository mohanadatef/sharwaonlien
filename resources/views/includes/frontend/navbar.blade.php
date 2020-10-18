<nav id="navbar" class="navbar navbar-expand-lg navbar-dark nav-style bg-white justify-content-center shadow-sm">
    <form autocomplete="off"  action="{{ url('/item1') }}" class="img-logowhite1 logo-margin1 logo-hide1" method="post"  data-width="fit">
        {{csrf_field()}}
        <div  style="width:150px;color:black" class="autocomplete">
            <input  class="form-control" id="myInput1" name="name" type="text" value="{{Request::old('name')}}" placeholder="search">
        </div>
        <input type="submit" value="search">
    </form>
    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars"
            aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div id="navbarContent" class="collapse navbar-collapse">
        <a href="{{ url('') }}">
            <img class="img-logowhite logo-margin logo-hide" src="{{ asset('public/images/setting/' . $setting->logo ) }}">
        </a>

        <ul id="MainMenu" class="navbar-nav mr-auto nav-margin top">
            <li class="nav-item"><a id="home" onclick="selectItem('home')" href="{{ url('/') }}" class="nav-link unselected-item">Home</a></li>
            @if($discount > 0)
            <li class="nav-item"><a id="home" onclick="selectItem('discount')" href="{{ url('/discount') }}" class="nav-link unselected-item">Sale Now !</a></li>
           @endif
            <li class="nav-item dropdown">
                <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   class="nav-link">Filter</a>
                <ul aria-labelledby="dropdownMenu1" class="dropdown-menu sub border-0 shadow submenu1">
                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu submenu2">
                        <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" class="dropdown-item">
                            Size
                            <!-- English Arrow -->
                            <i class="fas fa-caret-right"></i>
                            <!-- Arabic Arrow -->
                        </a>
                        <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0  shadow submenu2">
                            @foreach($size as $name)
                            <li><a tabindex="-1" href="{{url('/item/'.$name)}}" class="dropdown-item">{{$name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown-submenu submenu2">
                        <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" class="dropdown-item">
                            Color
                            <!-- English Arrow -->
                            <i class="fas fa-caret-right"></i>
                            <!-- Arabic Arrow -->
                        </a>
                        <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0  shadow submenu2">
                            @foreach($color as $name)
                                <li><a tabindex="-1" href="{{url('/item/'.$name)}}" class="dropdown-item">{{$name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown-submenu submenu2">
                        <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" class="dropdown-item">
                            Type
                            <!-- English Arrow -->
                            <i class="fas fa-caret-right"></i>
                            <!-- Arabic Arrow -->
                        </a>
                        <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0  shadow submenu2">
                            @foreach($type as $name)
                                <li><a tabindex="-1" href="{{url('/item/'.$name)}}" class="dropdown-item">{{$name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown-submenu submenu2">
                        <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" class="dropdown-item">
                            Description
                            <!-- English Arrow -->
                            <i class="fas fa-caret-right"></i>
                            <!-- Arabic Arrow -->
                        </a>
                        <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border-0  shadow submenu2">
                            @foreach($category_type as $name)
                                <li><a tabindex="-1" href="{{url('/item/'.$name)}}" class="dropdown-item">{{$name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
{{--            <li class="nav-item"><a id="about_us"  onclick="selectItem('about_us')" href="{{ url('/about_us') }}" class="nav-link unselected-item">About US</a></li>
            <li class="nav-item"><a id="job" onclick="selectItem('job')" href="{{ url('/job') }}"
                                    class="nav-link unselected-item">Career</a></li>
            <li class="nav-item"><a id="contact_us" href="{{ url('/contact_us') }}" onclick="selectItem('contact_us')"
                                    class="nav-link unselected-item">Contact Us</a></li>--}}
            <li class="nav-item"><a id="cart" href="{{ url('/cart') }}" onclick="selectItem('cart')"
                                    class="nav-link unselected-item">Your Cart <span style="color: #f8b6af">@if(Illuminate\Support\Facades\Cookie::get('cart') != null )<i class="ace-icon fa fa-shopping-cart">{{$cookie}} </i>   @else<i class="ace-icon fa fa-shopping-cart"></i>@endif</span></a></li>
            @if (Route::has('login'))
                @auth

                    <li class="nav-item dropdown">
                        <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           class="nav-link"> {{ Auth::user()->username }}</a>
                        <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow submenu1 sub">
                            <li><a id="profile" href="{{ url('/profile') }}" onclick="selectItem('profile')"
                                   class="dropdown-item">Profile</a></li>
                            <li><a id="your_history" href="{{ url('/your_history') }}"
                                   onclick="selectItem('your_history')"
                                   class="dropdown-item">your history</a></li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();selectItem('logout');
                                                     document.getElementById('logout-form').submit();" id="logout">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <!-- <li class="dropdown-divider"></li> -->
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                           class="nav-link">Sign Up</a>
                        <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow submenu1 sub">
                            <li><a id="sign_up" href="{{ url('/sign_up') }}" onclick="selectItem('sign_up')"
                                   class="dropdown-item">sign up</a></li>
                            <li><a id="register" href="{{ url('/register') }}" onclick="selectItem('register')"
                                   class="dropdown-item">Register</a></li>
                            <!-- <li class="dropdown-divider"></li> -->
                        </ul>
                    </li>
                @endauth
            @endif


           </ul>

    </div>
</nav>
@yield('navbar')
