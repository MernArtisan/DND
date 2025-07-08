@extends('web.layouts.master')
@section('title', 'Live Streams')
@section('content')

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Live Stream</h1>
                <!-- <h2 class="breadcumb-bg-title">Events</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Live Stream</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
            Tournament Area
            ==============================-->
    <section class="vs-events-wrapper events-layout1 space-top space-md-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="vs-events d-lg-flex" data-bg-src="{{asset('web/assets/img/shape/events-bg-1.png')}}">
                        <div class="media-img">
                            <img src="{{asset('web/assets/img/tournament/t-img-1.png')}}" alt="Tournament Image">
                        </div>
                        <div class="media-body align-self-center">
                            <h3 class="events-name h5 text-white"><a href="#">2025 WORLD
                                    CHAMPIONSHIP</a></h3>
                            <ul class="events-list list-style-none">
                                <li class="text-white"><span class="text-white">Date:</span>June 1 - October 31, 2025
                                </li>
                                <li class="text-white"><span class="text-white">Sports:</span>Rugby</li>
                                <li class="text-white"><span class="text-white">Teams:</span>280</li>
                                <li class="text-white"><span class="text-white">Prize Pool:</span>120,000$</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="vs-events d-lg-flex" data-bg-src="{{asset('web/assets/img/shape/events-bg-1.png')}}">
                        <div class="media-img">
                            <img src="{{asset('web/assets/img/tournament/t-img-2.png')}}" alt="Tournament Image">
                        </div>
                        <div class="media-body align-self-center">
                            <h3 class="events-name h5 text-white"><a href="#">2025 Rank Topper</a>
                            </h3>
                            <ul class="events-list list-style-none">
                                <li class="text-white"><span class="text-white">Date:</span>July 05 - November 31, 2025
                                </li>
                                <li class="text-white"><span class="text-white">Sports:</span>UFC</li>
                                <li class="text-white"><span class="text-white">Teams:</span>320</li>
                                <li class="text-white"><span class="text-white">Prize Pool:</span>112,000$</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="vs-events d-lg-flex" data-bg-src="{{asset('web/assets/img/shape/events-bg-1.png')}}">
                        <div class="media-img">
                            <img src="{{asset('web/assets/img/tournament/t-img-3.png')}}" alt="Tournament Image">
                        </div>
                        <div class="media-body align-self-center">
                            <h3 class="events-name h5 text-white"><a href="#">2025 WORLD
                                    Legend</a></h3>
                            <ul class="events-list list-style-none">
                                <li class="text-white"><span class="text-white">Date:</span>Augest 1 - October 22, 2025
                                </li>
                                <li class="text-white"><span class="text-white">Sports:</span>Football</li>
                                <li class="text-white"><span class="text-white">Teams:</span>522</li>
                                <li class="text-white"><span class="text-white">Prize Pool:</span>99,000$</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="vs-events d-lg-flex" data-bg-src="{{asset('web/assets/img/shape/events-bg-1.png')}}">
                        <div class="media-img">
                            <img src="{{asset('web/assets/img/tournament/t-img-4.png')}}" alt="Tournament Image">
                        </div>
                        <div class="media-body align-self-center">
                            <h3 class="events-name h5 text-white"><a href="#">2025 Topper Sports</a>
                            </h3>
                            <ul class="events-list list-style-none">
                                <li class="text-white"><span class="text-white">Date:</span>July 12 - Augest 18, 2025
                                </li>
                                <li class="text-white"><span class="text-white">Sports:</span>Snooker</li>
                                <li class="text-white"><span class="text-white">Teams:</span>85</li>
                                <li class="text-white"><span class="text-white">Prize Pool:</span>123,000$</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==============================
            Match Area
            ==============================-->
    <section class="vs-match-wrapper vs-match-layout1 newsletter-pb">
        <div class="container ">
            <div class="text-center">
                <div class="filter-menu-style1 filter-menu-active mb-70">
                    <button data-filter="*" class="active">All</button>
                    <button data-filter=".csgo"> Rugby</button>
                    <button data-filter=".dota">UFC</button>
                    <button data-filter=".fortnite">Football</button>
                    <button data-filter=".pubg">Snooker</button>
                </div>
            </div>
            <div class="mb-15 filter-active row">
                <div class="col-md-6 col-lg-12 grid-item pubg fortnite csgo ">
                    <div class="vs-match">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-lg-3">
                                <div class="match-logo">
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-7.png')}}" alt="Team Logo"></a>
                                    <span class="versus">vs</span>
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-8.png')}}" alt="Team Logo"></a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="match-about pl-35">
                                    <h3 class="team-name h5 text-white mb-1 mb-lg-2"><a href="#">LOREM IPSUM</a> <span
                                            class="text-theme">vs</span> <a href="#">LOREM IPSUM</a></h3>
                                    <p class="match-date mb-0">December 25, 2025 4:00 PM</p>
                                </div>
                            </div>
                            <div class="col-auto col-xl-2">
                                <div class="match-time text-white">3 : 8</div>
                            </div>
                            <div class="col-auto col-xl-2 text-end ">
                                <a href="#" class="icon-btn1 popup-video"><i class="fas fa-wifi"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 grid-item  fortnite csgo dota">
                    <div class="vs-match">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-lg-3">
                                <div class="match-logo">
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-1.png')}}" alt="Team Logo"></a>
                                    <span class="versus">vs</span>
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-2.png')}}" alt="Team Logo"></a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="match-about pl-35">
                                    <h3 class="team-name h5 text-white mb-1 mb-lg-2"><a href="#">LOREM IPSUM</a> <span
                                            class="text-theme">vs</span> <a href="#">LOREM IPSUM</a></h3>
                                    <p class="match-date mb-0">December 25, 2025 4:00 PM</p>
                                </div>
                            </div>
                            <div class="col-auto col-xl-2">
                                <div class="match-time text-white">3 : 5</div>
                            </div>
                            <div class="col-auto col-xl-2 text-end ">
                                <a href="#" class="icon-btn1 popup-video"><i class="fas fa-wifi"></i></a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 grid-item pubg  csgo dota">
                    <div class="vs-match">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-lg-3">
                                <div class="match-logo">
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-3.png')}}" alt="Team Logo"></a>
                                    <span class="versus">vs</span>
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-4.png')}}" alt="Team Logo"></a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="match-about pl-35">
                                    <h3 class="team-name h5 text-white mb-1 mb-lg-2"><a href="#">LOREM IPSUM</a> <span
                                            class="text-theme">vs</span> <a href="#">LOREM IPSUM</a></h3>
                                    <p class="match-date mb-0">December 25, 2025 4:00 PM</p>
                                </div>
                            </div>
                            <div class="col-auto col-xl-2">
                                <div class="match-time text-white">2 : 4</div>
                            </div>
                            <div class="col-auto col-xl-2 text-end ">
                                <a href="#" class="icon-btn1 popup-video"><i class="fas fa-wifi"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12 grid-item pubg fortnite  dota">
                    <div class="vs-match">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-lg-3">
                                <div class="match-logo">
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-5.png')}}" alt="Team Logo"></a>
                                    <span class="versus">vs</span>
                                    <a href="#"><img src="{{asset('web/assets/img/logos/logo-1-6.png')}}" alt="Team Logo"></a>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="match-about pl-35">
                                    <h3 class="team-name h5 text-white mb-1 mb-lg-2"><a href="#">LOREM IPSUM</a> <span
                                            class="text-theme">vs</span> <a href="#">LOREM IPSUM</a></h3>
                                    <p class="match-date mb-0">December 25, 2025 4:00 PM</p>
                                </div>
                            </div>
                            <div class="col-auto col-xl-2">
                                <div class="match-time text-white">1 : 6</div>
                            </div>
                            <div class="col-auto col-xl-2 text-end ">
                                <a href="#" class="icon-btn1 popup-video"><i class="fas fa-wifi"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('web.components.newsletter')

@endsection