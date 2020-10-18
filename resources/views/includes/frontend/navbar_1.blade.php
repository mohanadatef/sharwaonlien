<nav id="navbar" class="navbar navbar-expand-lg navbar-dark nav-style bg-white justify-content-center shadow-sm">


    <div id="navbarContent" class="collapse navbar-collapse">


        <ul id="MainMenu" class="navbar-nav mr-auto nav-margin top">
            @foreach($type as $mytype)
                <li class="nav-item"><a href="{{ url('/item/'.$mytype->id) }}"
                                        class="nav-link unselected-item">{{$mytype->name}}</a></li>
    @endforeach </ul>

    </div>

</nav>
@yield('navbar_1')
