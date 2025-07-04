<footer class="footer-wrapper footer-layout1 bg-fluid bg-major-black position-relative">
    <div class="bg-fluid d-none d-none d-xl-block position-absolute start-0 top-0 w-100 h-100"
        data-bg-src="{{asset('web/assets/img/bg/footer-background-1.jpg')}}"></div>
    <div class="footer-widget-wrapper  dark-style1 z-index-common">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-lg-3 col-xl-4">
                    <div class="widget footer-widget pt-0">
                        <h3 class="widget_title">{{$general_content->dndsports}}</h3>
                        <div class="vs-widget-about">
                            <p class="about-text text-footer1 pe-xl-5">{{$general_content->description}}</p>
                            <div class="d-flex gap-2 text-white mt-45">
                                <a class="icon-btn" href="{{$general_content->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                <a class="icon-btn" href="{{$general_content->twitter}}"><i class="fab fa-twitter"></i></a>
                                <a class="icon-btn" href="{{$general_content->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                                <a class="icon-btn" href="{{$general_content->youtube}}"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                    <div class="widget widget_categories footer-widget   ">
                        <h3 class="widget_title">Quick Links</h3>
                        <ul>
                            <li><a href="{{route('home.index')}}">Home</a></li>
                            <li><a href="{{route('news.index')}}">News</a></li>
                            <li><a href="{{route('liveStreams.index')}}">Live Stream</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-xl-2">
                    <div class="widget widget_nav_menu footer-widget  ">
                        <h3 class="widget_title">Connect</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="{{route('staff.index')}}">Staff</a></li>
                                <li><a href="{{route('corporateSponsors.index')}}">Corporate Sponsor</a></li>
                                <li><a href="{{route('contact.index')}}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3">
                    <div class="widget footer-widget  ">
                        <h3 class="widget_title">Contact Us</h3>
                        <div class="vs-widget-about">
                            <p class="contact-info"><i class="fal fa-map-marker-alt text-white"></i>{{$general_content->address}}</p>
                            <p class="contact-info"><i class="fal fa-phone text-white"></i><a
                                    href="tel:+65965252561">{{$general_content->phone}}</a></p>
                            <p class="contact-info"><i class="fal fa-envelope text-white"></i><a
                                    href="mailto:info@example.com">{{$general_content->email}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright bg-black z-index-step1">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-auto align-self-center text-center py-3 py-xl-0 text-xl-start">
                    <p class="copywrite-text">{{$general_content->copyright}} <a href="{{route('home.index')}}">DND Sports Network</a> {{$general_content->rights}}</p>
                </div>
                <div class="col-xl-auto d-none d-xl-block">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="{{route('privacy.index')}}">Privacy Policy</a></li>
                            <li><a href="{{route('terms.index')}}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>