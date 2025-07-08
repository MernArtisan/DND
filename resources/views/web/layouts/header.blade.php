<div class="preloader  ">
    <button class="vs-btn preloaderCls">Cancel Preloader </button>
    <div class="preloader-inner">
        <div class="loader-logo">
            <img src="{{ asset('web/assets/img/main-logo-1.png') }}" alt="Loader Image">
        </div>
        <div class="loader-wrap pt-4">
            <span class="loader"></span>
        </div>
    </div>
</div>
<!--========================
    Sticky Header
    ========================-->
<div class="sticky-header-wrap sticky-header bg-black py-1 py-sm-2 py-lg-1">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-5 col-md-3">
                <div class="logo">
                    <a href="{{ route('home.index') }}"><img src="{{ asset('web/assets/img/main-logo-1.png') }}"
                            alt="main-logo"></a>
                </div>
            </div>
            <div class="col-7 col-md-9 text-end position-static">
                <nav class="main-menu menu-sticky1 d-none d-lg-block link-inherit">
                    <ul>
                        <li>
                            <a href="{{ route('home.index') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('news.index') }}">News</a>
                        </li>
                        <li>
                            <a href="{{ route('staff.index') }}">Staff</a>
                        </li>
                        <li>
                            <a href="{{ route('Channels.index') }}">Channels</a>
                        </li>
                        <li>
                            <a href="{{ route('corporateSponsors.index') }}">Corporate Sponsor</a>
                        </li>
                        <li>
                            <a href="{{ route('liveStreams.index') }}">Live Stream</a>
                        </li>
                        <li>
                            <a href="{{ route('contact.index') }}">Contact</a>
                        </li>
                    </ul>
                </nav>
                <button class="vs-menu-toggle text-theme border-theme d-inline-block d-lg-none"><i
                        class="far fa-bars"></i></button>
            </div>
        </div>
    </div>
</div>
<!--==============================
    Sidemenu
    ============================== -->
<div class="sidemenu-wrapper d-none d-lg-block  ">
    <div class="sidemenu-content bg-light-dark">
        <button class="closeButton border-theme text-theme bg-theme-hover sideMenuCls"><i
                class="far fa-times"></i></button>
        <div class="about-box">
            <a href="{{ route('home.index') }}"><img src="{{ asset('web/assets/img/main-logo-1.png') }}"
                    alt="main-logo"></a>
            <p class="text-light mt-3">{{ $general_content->description }}</p>
            <ul class="social-links fs-xs text-white">
                <li><a href="{{ $general_content->facebook }}" class="icon-btn" target="_blank"><i
                            class="fab fa-facebook-f"></i></a></li>
                <li><a href="{{ $general_content->twitter }}" class="icon-btn" target="_blank"><i
                            class="fab fa-twitter"></i></a></li>
                <li><a href="{{ $general_content->linkedin }}" class="icon-btn" target="_blank"><i
                            class="fab fa-linkedin-in"></i></a></li>
                <li><a href="{{ $general_content->youtube }}" class="icon-btn" target="_blank"><i
                            class="fab fa-youtube"></i></a></li>
            </ul>
            <div class="my-40">
                <div class="info-style1">
                    <span class="icon-btn2"><i class="fas fa-map-marker-alt"></i></span>
                    <p class="fs-4 lh-1 fw-medium text-white mb-0">Address</p>
                    <p class="text-white mb-0">{{ $general_content->address }}</p>
                </div>
                <div class="info-style1">
                    <span class="icon-btn2"><i class="fas fa-phone"></i></span>
                    <p class="fs-4 lh-1 fw-medium text-white mb-0">Get In Touch</p>
                    <p class="text-white mb-0"><a href="tel:13456789"
                            class="text-inherit">{{ $general_content->phone }}</a></p>
                </div>
                <div class="info-style1">
                    <span class="icon-btn2"><i class="fas fa-envelope"></i></span>
                    <p class="fs-4 lh-1 fw-medium text-white mb-0">Mail Us</p>
                    <p class="text-white mb-0"><a href="mailto:info@example.com"
                            class="text-inherit">{{ $general_content->email }}</a></p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="vs-menu-wrapper">
    <div class="vs-menu-area bg-dark">
        <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="{{ route('home.index') }}"><img src="{{ asset('web/assets/img/main-logo-1.png') }}"
                    alt="main-logo"></a>
        </div>
        <div class="vs-mobile-menu link-inherit"></div><!-- Menu Will Append With Javascript -->
    </div>
</div>

<header class="header-wrapper header-layout2 mt-30">
    <div class="container position-relative">
        <div class="bg-fluid" data-bg-src="{{ asset('web/assets/img/shape/header-bg-2-1.jpg') }}">
            <div class="header-top">
                <div class="container px-0">
                    <div class="top-innner">
                        <div class="row align-items-center">
                            <!-- <div class="col-sm-6 d-none d-md-block">
                                    <p class="top-title">Welcome to our great eSports Team. <a class="text-inherit" href="#"><u class=" fw-bold">Join Now!</u></a></p>
                                </div> -->
                            <!--=========my-pop-up=======-->
                            <div class="col-sm-6 d-none d-md-block">
                                <p class="top-title">{{ $general_content->welcome }}
                                </p>
                            </div>

                            <!-- Register Popup -->
                            <div id="registerPopup" class="popup">
                                <div class="popup-content">
                                    <span id="closePopup" class="close">&times;</span>
                                    <h2>Register</h2>
                                    <form id="registerForm">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">User Name:</label>
                                            <input type="text" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" id="password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password">Confirm Password:</label>
                                            <input type="password" id="confirm-password" name="confirm-password"
                                                required>
                                        </div>

                                        <div class="form-group remember-me">
                                            <input type="checkbox" id="remember-me" name="remember-me">
                                            <label for="remember-me">Remember me</label>
                                        </div>


                                        <button type="submit" class="vs-btn gradient-btn">Register</button>
                                    </form>
                                </div>
                            </div>
                            <!--=========my-pop-up=======-->

                            <div class="col-sm-6 text-end d-none d-md-block">
                                <div class="d-flex align-items-center justify-content-end">
                                    <ul class="social-links fs-xs text-white">
                                        @if (Auth::user())
                                            <li>
                                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn border-0 bg-transparent p-0 text-start">
                                                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                                                    </button>
                                                </form>
                                            </li>
                                        @endif

                                        <li><a href="{{ $general_content->facebook }}" class="icon-btn6"
                                                target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="{{ $general_content->twitter }}" class="icon-btn6"
                                                target="_blank"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{ $general_content->linkedin }}" class="icon-btn6"
                                                target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="{{ $general_content->youtube }}" class="icon-btn6"
                                                target="_blank"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-30">
                <div class="row align-items-center">
                    <div class="col-6 col-lg-3 col-xl-2">
                        <div class="header-logo py-3 py-lg-0">
                            <a href="{{ route('home.index') }}"><img src="{{ asset('web/assets/img/main-logo-1.png') }}"
                                    alt="main-logo"></a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-xl-5 text-end">
                        <nav class="main-menu menu-style1 mobile-menu-active ">
                            <ul>
                                <li>
                                    <a href="{{ route('home.index') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('news.index') }}">News</a>
                                </li>
                                <li>
                                    <a href="{{ route('staff.index') }}">Staff</a>
                                </li>
                                <li>
                                    <a href="{{ route('Channels.index') }}">Channels</a>
                                </li>
                                <li>
                                    <a href="{{ route('corporateSponsors.index') }}">Corporate Sponsor</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact.index') }}">Contact</a>
                                </li>
                            </ul>
                        </nav>
                        <button type="button" class="vs-menu-toggle text-white d-inline-block d-lg-none"> <i
                                class="far fa-bars"></i></button>
                    </div>
                    <div class="col-lg-8 col-xl-5 d-none d-lg-block">
                        <div class="header-right d-flex align-items-center justify-content-end">
                            <a href="{{ route('liveStreams.index') }}"
                                class="vs-btn outline3 d-none d-xl-inline-block"><i class="fas fa-wifi"></i><strong>Live
                                    Streaming</strong></a>
                            @if(Auth::check())
                                <a href="#"> <button class="icon-btn7 sideCartToggler has-badge mr-10" type="button">
                                        <i class="fa fa-user">
                                            {{ Auth::user()->name }}
                                        </i>
                                    </button></a>
                            @else
                                <a href="{{ route('signup.index') }}"> <button
                                        class="icon-btn7 sideCartToggler has-badge mr-10" type="button">
                                        <i class="fa fa-user-plus"></i>
                                    </button></a>
                            @endif

                            @if (!Auth::check())
                                <a href="{{ route('login.index') }}"> <button class="icon-btn7 sideCartToggler has-badge"
                                        type="button">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </button></a>
                            @endif
                            <ul class="header-list1 list-style-none">
                                <li>
                                    <button class="icon-btn7 sideMenuToggler"><i class="far fa-bars"></i></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    // Get elements
    const joinNowLink = document.getElementById('joinNowLink');
    const registerPopup = document.getElementById('registerPopup');
    const closePopup = document.getElementById('closePopup');

    // Open Popup
    joinNowLink.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default link behavior
        registerPopup.style.display = 'flex';
    });

    // Close Popup
    closePopup.addEventListener('click', () => {
        registerPopup.style.display = 'none';
    });

    // Close Popup when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === registerPopup) {
            registerPopup.style.display = 'none';
        }
    });

    // Form Submission
    document.getElementById('registerForm').addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Simple validation
        if (name && email && password) {
            alert(`Thank you, ${name}! You have successfully registered.`);
            registerPopup.style.display = 'none'; // Close popup after registration
        } else {
            alert('Please fill out all fields.');
        }
    });
</script>