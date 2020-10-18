<section id="footer">
    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4 footer-img">

        <!-- Footer Links -->
        <div class="container text-center">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6">

                    <!-- Content -->
                    <!-- Links -->
                    <h5 class="text-footer">our link</h5>

                    <ul class="footer-link-ul">
                        <div class="row">
                            <div class="col-md-4">
                                <li class="footer-link-li">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="footer-link-li">
                                    <a href="{{ url('/about_us') }}">About Us</a>
                                </li>
                            </div>
                            <div class="col-md-4">
                                <li class="footer-link-li">
                                    <a href="{{ url('/contact_us') }}">Contact Us</a>
                                </li>
                                <li class="footer-link-li">
                                    <a href="{{ url('/job') }}">Career</a>
                                </li>
                            </div>
                            @if (Route::has('login'))
                                @auth
                                    <div class="col-md-4">
                                        <li class="footer-link-li">
                                            <a href="{{ url('/profile') }}">Profile</a>
                                        </li>
                                        <li class="footer-link-li">
                                            <a href="{{ url('/cart') }}">check now</a>
                                        </li>
                                        <li class="footer-link-li">
                                            <a href="{{ url('/your_history') }}">your history</a>
                                        </li>
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <li class="footer-link-li">
                                            <a href="{{ url('/login') }}">Sign Up</a>
                                        </li>
                                        <li class="footer-link-li">
                                            <a href="{{ url('/register') }}">register</a>
                                        </li>
                                    </div>
                                @endauth
                            @endif

                        </div>
                    </ul>

                </div>
                <!-- Grid column -->
                <div class="col-md-6">

                    <!-- Content -->
                    <!-- Social -->
                    <h5 class="text-footer">Follow Us</h5>

                    <div class="footer-social-icons">
                        <a href="http://{{$setting->facebook}}" style="text-decoration: none;color: inherit;"> <span
                                    class="footer-icon"><i class="fab fa-facebook-square"></i></span> </a>
                        <a href="http://{{$setting->instgram}}" style="text-decoration: none;color: inherit;"> <span
                                    class="footer-icon"><i class="fab fa-instagram"></i></span> </a>
                    </div>

                </div>


            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">Copyright © 2019 | ALL RIGHTS RESERVED TO Mohanad Atef
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

</section>
