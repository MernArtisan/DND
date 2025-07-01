@extends('web.layouts.master')
@section('title', 'Home')
@section('content')
    <div class="hero-layout2">
        <div class="row vs-carousel arrow-style3" data-arrows="true" data-dots="false" data-dots-lg-show="true"
            data-fade="true">
            @foreach ($banners as $banner)
                <div class="hero-inner">
                    <div class="hero-bg" data-bg-src="{{ asset('storage/' . $banner->image) }}"></div>
                    <div class="container">
                        <div class="hero-content">
                            @if ($banner->title)
                                <span class="hero-subtitle">{{ $banner->title }}</span>
                            @endif
                            @if ($banner->subtitle)
                                <h1 class="hero-title">{!! nl2br(e($banner->subtitle)) !!}</h1>
                            @endif
                            @if ($banner->description)
                                <p class="hero-text">{!! $banner->description !!}</p>
                            @endif
                            <div class="hero-btns">
                                <a href="#" class="vs-btn outline1 me-3">asd <i class="fas fa-wifi"></i></a>
                                <a href="#" class="vs-btn outline3">gytry<i class="fas fa-users"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <section class="vs-about-wrapper position-relative space">
        <div class="position-absolute bottom-0 start-0 d-none d-lg-block"><img
                src="{{ asset('web/assets/img/shape/about-1-2.png') }}" alt="BG Shape"></div>
        <div class="container z-index-common">
            <div class="row">
                <div class="col-lg-6 mb-20 mb-lg-0">
                    <div class="img-box1 hover-shape">
                        <img src="{{ asset('web/assets/img/about/about.webp') }}" class="w-100 d-block" alt="About Image">
                        <div class="exp-box1 text-start">
                            <h2 class="h1 text-gradient mb-0 counter"><span class="number">5</span>+</h2>
                            <p class="exp-text mb-0">Years Of Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-content1 pl-35">
                        <h2 class="sec-title2">{{ $cms_content[0]->name }}</h2>
                        <p class="mb-30 text-justify">{{ $cms_content[0]->description }}</p>
                        <h3 class="h5 font-theme">Lorem Ipsum - Pro Player</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-timetable-wrapper vs-timetable-layout1 space"
        data-bg-src="{{ asset('web/assets/img/bg/background.jpeg') }}">
        <div class="container pb-35">
            <div class="row">
                <div class="col-md-5 col-lg-6 col-xl-6">
                    <div class="section-title has-title-rotate">
                        <span class="title-rotate">{{ $cms_content[1]->name }}</span>
                        <h2 class="sec-title1 text-white">{{ $cms_content[1]->description }}</h2>
                    </div>
                </div>
            </div>
            <div class="text-center text-xl-end">
                <div class="timetable-style1">
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box">
                            <p class="day mb-0">Monday</p>
                            <p class="name mb-0">Not Streaming</p>
                        </a>
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box">
                            <p class="time mb-0">2:00 AM - 9:00 AM cet</p>
                            <p class="day mb-0">Tuesday</p>
                            <p class="name mb-0">Call of duty</p>
                        </a>
                    </div>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box">
                            <p class="day mb-0">Wednesday</p>
                            <p class="name mb-0">Not Streaming</p>
                        </a>
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box">
                            <p class="time mb-0">2:00 AM - 9:00 AM cet</p>
                            <p class="day mb-0">Thursday</p>
                            <p class="name mb-0">Call of duty</p>
                        </a>
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box active">
                            <p class="time mb-0">2:00 AM - 9:00 AM cet</p>
                            <p class="day mb-0">Friday</p>
                            <p class="name mb-0">Call of duty</p>
                        </a>
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box">
                            <p class="time mb-0">2:00 AM - 9:00 AM cet</p>
                            <p class="day mb-0">Saturday</p>
                            <p class="name mb-0">Call of duty</p>
                        </a>
                    </div>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('liveStreams.index') }}" class="timetable-box">
                            <p class="time mb-0">2:00 AM - 9:00 AM cet</p>
                            <p class="day mb-0">Sunday</p>
                            <p class="name mb-0">Call of duty</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-streams-wrapper bg-secondary space-bottom">
        <div class="container">
            <div class="space-top">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-8">
                        <div class="section-title text-center">
                            <span class="sub-title">{{ $cms_content[2]->name }}</span>
                            <h2 class="sec-title1 text-center">{{ $cms_content[2]->description }}</h2>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="filter-menu-style1 mb-40 vs-slider-tab redwan" data-asnavfor="#slideStrem">
                        <a href="#" class="tab-btn active">Rugby </a>
                        <a href="#" class="tab-btn">UFC </a>
                        <a href="#" class="tab-btn">Football</a>
                        <a href="#" class="tab-btn">Snooker</a>
                        <a href="#" class="tab-btn">Basketball</a>
                    </div>
                    <div class="position-relative arrow-wrap">
                        <div id="slideStrem" class="strem-video1 vs-carousel arrow-white" data-slide-show="1"
                            data-arrows="true" data-speed="500" data-infinite="fasle">
                            <div class="position-relative image-scale-hover">
                                <a class="popup-video" href="#"><img class="w-100"
                                        src="{{ asset('web/assets/img/video/rugby-img.jpg') }}" alt="Video Thumb"></a>
                                <a class="popup-video play-btn overlay-center" href="#"><i class="fas fa-play"></i></a>
                            </div>
                            <div class="position-relative image-scale-hover">
                                <a class="popup-video" href="#"><img class="w-100"
                                        src="{{ asset('web/assets/img/video/rugby-img.jpg') }}" alt="Video Thumb"></a>
                                <a class="popup-video play-btn overlay-center" href="#"><i class="fas fa-play"></i></a>
                            </div>
                            <div class="position-relative image-scale-hover">
                                <a class="popup-video" href="#"><img class="w-100"
                                        src="{{ asset('web/assets/img/video/rugby-img.jpg') }}" alt="Video Thumb"></a>
                                <a class="popup-video play-btn overlay-center" href="#"><i class="fas fa-play"></i></a>
                            </div>
                            <div class="position-relative image-scale-hover">
                                <a class="popup-video" href="#"><img class="w-100"
                                        src="{{ asset('web/assets/img/video/playing-snooker.jpg') }}" alt="Video Thumb"></a>
                                <a class="popup-video play-btn overlay-center" href="#"><i class="fas fa-play"></i></a>
                            </div>
                            <div class="position-relative image-scale-hover">
                                <a class="popup-video" href="#"><img class="w-100"
                                        src="{{ asset('web/assets/img/video/rugby-img.jpg') }}" alt="Video Thumb"></a>
                                <a class="popup-video play-btn overlay-center" href="#"><i class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-contact-wrapper bg-light-dark space">
        <div class="container">
            <div class="row gx-60">
                <div class="col-lg-6 mb-30 mb-lg-0">
                    <div class="row">
                        <div class="col-11 col-md-6  col-lg-12">
                            <div class="section-title has-title-rotate">
                                <span class="title-rotate">{{ $cms_content[3]->name }}</span>
                                <h2 class="sec-title1 text-white">{{ $cms_content[3]->description }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="info-box2 px-60 py-60 mb-40">
                        <div class="info-style1 text-center text-sm-start">
                            <span class="icon-btn2"><i class="fas fa-map-marker-alt"></i></span>
                            <p class="fs-4 lh-1 fw-medium text-white mb-1 mb-sm-0">Address</p>
                            <p class="text-white mb-0">{{$general_content->address}}</p>
                        </div>
                        <div class="info-style1 text-center text-sm-start">
                            <span class="icon-btn2"><i class="fas fa-phone"></i></span>
                            <p class="fs-4 lh-1 fw-medium text-white mb-1 mb-sm-0">Get In Touch</p>
                            <p class="text-white mb-0"><a href="tel:13456789" class="text-inherit">85 125 1256 12145</a></p>
                        </div>
                        <div class="info-style1 text-center text-sm-start">
                            <span class="icon-btn2"><i class="fas fa-envelope"></i></span>
                            <p class="fs-4 lh-1 fw-medium text-white mb-1 mb-sm-0">Mail Us</p>
                            <p class="text-white mb-0"><a href="mailto:info@example.com"
                                    class="text-inherit">{{$general_content->email}}</a></p>
                        </div>
                    </div>
                    <span class="text-white fw-medium fs-4">Follow Me On:</span>
                    <div class="d-inline-flex gap-2 mt-2 mt-sm-0 ms-sm-3">
                        <a class="icon-btn" href="{{$general_content->facebook}}" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="icon-btn" href="{{$general_content->twitter}}" target="_blank"><i
                                class="fab fa-twitter"></i></a>
                        <a class="icon-btn" href="{{$general_content->linkedin}}" target="_blank"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a class="icon-btn" href="{{$general_content->youtube}}" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('inquiry.submit') }}" method="POST"
                        class="contact-form contact-form-style1 form-dark px-60 py-60 ">
                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <label class="text-white" for="name">Enter Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name">
                                <i class="fal fa-user"></i>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label class="text-white" for="email">Enter Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Enter Your Email">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="col-12 form-group">
                                <label class="text-white" for="message">Enter Message</label>
                                <textarea class="form-control" id="message" rows="5" cols="50" name="message"
                                    placeholder="Your Message"></textarea>
                                <i class="fal fa-pencil-alt"></i>
                            </div>
                            <div class="col-12 form-group mb-0">
                                <button type="submit" class="vs-btn gradient-btn ">Submit Your Quote</button>
                                <p class="form-messages text-white mt-20 mb-0"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-blog-wrapper vs-blog-layout2 link-inherit space-top space-md-bottom" id="blog">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-8">
                    <div class="section-title text-center">
                        <span class="sub-title">{{ $cms_content[4]->name }}</span>
                        <h2 class="sec-title1 text-center">{{ $cms_content[4]->description }}</h2>
                    </div>
                </div>
            </div>
            <div class="row vs-carousel arrow-margin" data-arrows="true" data-slide-show="3" data-md-slide-show="2"
                data-sm-slide-show="1" data-xs-slide-show="1">
                <div class="col-xl-4">
                    <div class="vs-blog image-scale-hover">
                        <a href="{{ route('news.index') }}" class="overlay"></a>
                        <div class="blog-image">
                            <a href="{{ route('news.index') }}"><img src="{{ asset('web/assets/img/blog/news-1.jpg') }}"
                                    class="w-100" alt="Blog Image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta text-light fs-xs mb-10 text-white">
                                <a href="{{ route('news.index') }}"><i class="fal fa-calendar-alt"></i>January 22,
                                    2025</a>
                            </div>
                            <h3 class="blog-title h5 font-theme mb-0 text-white"><a href="{{ route('news.index') }}">Lorem
                                    ipsum is
                                    placeholder text commonly graphic</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="vs-blog image-scale-hover">
                        <a href="{{ route('news.index') }}" class="overlay"></a>
                        <div class="blog-image">
                            <a href="{{ route('news.index') }}"><img src="{{ asset('web/assets/img/blog/news-1.jpg') }}"
                                    class="w-100" alt="Blog Image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta text-light fs-xs mb-10 text-white">
                                <a href="{{ route('news.index') }}"><i class="fal fa-calendar-alt"></i>February 13,
                                    2025</a>
                            </div>
                            <h3 class="blog-title h5 font-theme mb-0 text-white"><a href="{{ route('news.index') }}">Lorem
                                    ipsum is
                                    placeholder text commonly graphic</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="vs-blog image-scale-hover">
                        <a href="{{ route('news.index') }}" class="overlay"></a>
                        <div class="blog-image">
                            <a href="{{ route('news.index') }}"><img src="{{ asset('web/assets/img/blog/news-1.jpg') }}"
                                    class="w-100" alt="Blog Image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta text-light fs-xs mb-10 text-white">
                                <a href="{{ route('news.index') }}"><i class="fal fa-calendar-alt"></i>March 18, 2025</a>
                            </div>
                            <h3 class="blog-title h5 font-theme mb-0 text-white"><a href="{{ route('news.index') }}">Lorem
                                    ipsum is
                                    placeholder text commonly graphic</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="vs-blog image-scale-hover">
                        <a href="{{ route('news.index') }}" class="overlay"></a>
                        <div class="blog-image">
                            <a href="{{ route('news.index') }}"><img src="{{ asset('web/assets/img/blog/news-1.jpg') }}"
                                    class="w-100" alt="Blog Image"></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta text-light fs-xs mb-10 text-white">
                                <a href="{{ route('news.index') }}"><i class="fal fa-calendar-alt"></i>Augest 19,
                                    2025</a>
                            </div>
                            <h3 class="blog-title h5 font-theme mb-0 text-white"><a href="{{ route('news.index') }}">Lorem
                                    ipsum is
                                    placeholder text commonly graphic</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-testimonial testimonial-layout1 space">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-11 position-relative">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <img class="position-absolute d-none d-xxl-inline-block start-0 top-100 translate-middle mb-xl-4"
                        src="{{ asset('web/assets/img/icons/quote-1.png') }}" alt="Quote">
                    <img class="position-absolute d-none d-xxl-inline-block start-100 top-100 translate-middle mb-xl-4"
                        src="{{ asset('web/assets/img/icons/quote-1.png') }}" alt="Quote">
                    <div class="testimonial-content text-center px-lg-4 mb-40 vs-carousel" data-slide-show="1" id="slide1"
                        data-asnavfor="#slide2, #slide3" data-fade="true">
                        <h2 class="testi-text mb-0">Lorem ipsum is placeholder text commonly used in the graphic, print,
                            and
                            publishing industries for <u>previewing layouts and visual mockups.</u></h2>
                        <h2 class="testi-text mb-0">From its medieval origins to the digital era, learn everything there is
                            to know about the ubiquitous lorem ipsum passage bled parts of Cicero's De Finibus Bo.</h2>
                        <h2 class="testi-text mb-0">The placeholder text, beginning with the line “Lorem ipsum dolor sit
                            amet, consectetur adipiscing elit”, looks like Latin because in its youth, centuries ago</h2>
                        <h2 class="testi-text mb-0">Richard McClintock, a Latin scholar from Hampden-Sydney College, is
                            credited with discovering the source behind the ubiquitous filler text. In seeing a sample of
                            lorem</h2>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="author-area pb-40">
                        <button
                            class="icon-btn4 d-none d-sm-inline-block position-absolute start-100 top-50 translate-middle-x"
                            data-slick-next="#slide2"><i class="fas fa-chevron-right"></i></button>
                        <button
                            class="icon-btn4 d-none d-sm-inline-block position-absolute start-0 top-50 translate-middle-x"
                            data-slick-prev="#slide2"><i class="fas fa-chevron-left"></i></button>
                        <div class="avater-slide1 vs-carousel mb-30" id="slide2" data-slide-show="3" data-center-mode="true"
                            data-xl-center-mode="true" data-ml-center-mode="true" data-lg-center-mode="true"
                            data-md-center-mode="true" data-sm-center-mode="true" data-xs-center-mode="true"
                            data-asnavfor="#slide1, #slide3">
                            <div class="avater">
                                <img src="{{ asset('web/assets/img/author/author-1.jpg') }}" alt="Author Image">
                            </div>
                            <div class="avater">
                                <img src="{{ asset('web/assets/img/author/author-1.jpg') }}" alt="Author Image">
                            </div>
                            <div class="avater">
                                <img src="{{ asset('web/assets/img/author/author-1.jpg') }}" alt="Author Image">
                            </div>
                            <div class="avater">
                                <img src="{{ asset('web/assets/img/author/author-1.jpg') }}" alt="Author Image">
                            </div>
                        </div>
                        <div class="author-name text-center vs-carousel" id="slide3" data-asnavfor="#slide2, #slide1"
                            data-slide-show="1" data-fade="true">
                            <div>
                                <h3 class="h5 mb-0">Sophia</h3>
                                <span>Sports</span>
                            </div>
                            <div>
                                <h3 class="h5 mb-0">Lily</h3>
                                <span>Sports</span>
                            </div>
                            <div>
                                <h3 class="h5 mb-0">John Moris</h3>
                                <span>Sports</span>
                            </div>
                            <div>
                                <h3 class="h5 mb-0">David Smith</h3>
                                <span>Sports</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ "></script>
    <script>
        const joinNowLink = document.getElementById('joinNowLink');
        const registerPopup = document.getElementById('registerPopup');
        const closePopup = document.getElementById('closePopup');


        joinNowLink.addEventListener('click', (event) => {
            event.preventDefault();
            registerPopup.style.display = 'flex';
        });


        closePopup.addEventListener('click', () => {
            registerPopup.style.display = 'none';
        });


        window.addEventListener('click', (event) => {
            if (event.target === registerPopup) {
                registerPopup.style.display = 'none';
            }
        });


        document.getElementById('registerForm').addEventListener('submit', (event) => {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;


            if (name && email && password) {
                alert(`Thank you, ${name}! You have successfully registered.`);
                registerPopup.style.display = 'none';
            } else {
                alert('Please fill out all fields.');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.contact-form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(form);
                    const messageBox = form.querySelector('.form-messages');
                    messageBox.innerText = '';
                    messageBox.classList.remove('text-success', 'text-danger');

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                        .then(async res => {
                            if (!res.ok) {
                                const errorData = await res.json();
                                const errors = errorData.errors || { general: ['Something went wrong.'] };
                                const firstError = Object.values(errors)[0][0];
                                throw new Error(firstError);
                            }
                            return res.json();
                        })
                        .then(data => {
                            toastr.success(data.message || 'You have successfully subscribed.');
                            form.reset();
                        })
                        .catch(error => {
                            console.error(error);
                            toastr.error(error.message || 'Something went wrong.');
                        });
                });
            });
        });
    </script>

@endsection