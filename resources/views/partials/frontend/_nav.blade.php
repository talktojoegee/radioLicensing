<header class="header-style-1">
    <div class="topbar-style-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="right-side">
                        <ul class="custom">
                            <li><a href="#" class="text-custom-white fs-14"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="text-custom-white fs-14"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="text-custom-white fs-14"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" class="text-custom-white fs-14"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Navigation -->
    <div class="main-navigation-style-1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="navigation">
                        <div class="logo">
                            <a href="index.html">
                                <img src="{{'/storage/'.$account->logo ?? 'https://via.placeholder.com/152x42' }}" class="img-fluid image-fit" alt="{{$account->organization_name ?? '' }}">
                            </a>
                        </div>
                        <div class="main-menu">
                            <div class="mobile-logo">
                                <a href="index.html">
                                    <img src="https://via.placeholder.com/152x42" class="img-fluid image-fit" alt="Logo">
                                </a>
                            </div>
                            <nav>
                                <ul class="custom">
                                    <li class="menu-item">
                                        <a href="{{route('org-homepage',['account'=>$account->sub_domain])}}" class="text-custom-white">Home</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#" class="text-custom-white">Services</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#" class="text-custom-white">Our Practitioners</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('contact-org', ['account'=>$account->sub_domain])}}" class="text-custom-white">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="right-side">
                                <div class="cta-btn">
                                    <a href="{{route('book-appointment')}}" class="btn-first btn-submit">
                                        Appointment
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="hamburger-menu">
                            <div class="menu-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
