@extends('web.layouts.master')
@section('title', 'Staff')
@section('content')
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Staff</h1>
                <!--  <h2 class="breadcumb-bg-title">Gamers</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Staff</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
        Team Area
        ==============================-->
    <section class="vs-team-wrapper vs-team-layout1 space-top newsletter-pb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-1.jpg')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">David Jones</a></h3>
                        <span class="team-degi text-light-white fs-xs">CO Founder of D & D Sports and current Head Football
                            Coach at Mingo Central High School</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-2.jpg')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">Darryl McCoy</a></h3>
                        <span class="team-degi text-light-white fs-xs">Co Founder of D & D Sports, Kentucky Sports Radio
                            (KSR) Sports personality, Broadcaster</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-3.png')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">Thomas Rainey</a></h3>
                        <span class="team-degi text-light-white fs-xs">Owner, Producer and Broadcaster</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-4.jpg')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">Kevin Keathly</a></h3>
                        <span class="team-degi text-light-white fs-xs">Co Host of the Grind Session and former professional
                            basketball coach</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-5.jpg')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">Kayla Vanhoose</a></h3>
                        <span class="team-degi text-light-white fs-xs">Volleyball Commentator and Coach at Bluegrass
                            Volleyball Academy</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-6.png')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">Austin Chafin</a></h3>
                        <span class="team-degi text-light-white fs-xs">Broadcaster, Producer, and Videographer</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-7.jpg')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">James Barker</a></h3>
                        <span class="team-degi text-light-white fs-xs">Producer and Broadcaster</span>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="vs-team bg-fluid" data-bg-src="{{asset('web/assets/img/shape/member-bg-1.png')}}">
                        <div class="team-img mb-35">
                            <a href="#"><img src="{{asset('web/assets/img/team/staff-8.jpg')}}" alt="Team Image"></a>
                        </div>
                        <h3 class="team-name h5 text-white mb-0"><a href="#">Ryan Martinez</a></h3>
                        <span class="team-degi text-light-white fs-xs">Graphic Designer</span>
                    </div>
                </div>
            </div>

            <!-- <div class="pagination-wrapper pagination-layout1 mt-lg-30 mb-30">
                    <ul>
                        <li><a href="#" class="active"><span class="text">1</span></a></li>
                        <li><a href="#"><span class='text'>2</span></a></li>
                        <li><a href="#"><span class='text'>3</span></a></li>
                        <li><a href="#"><span class='text'>4</span></a></li>
                    </ul>
                </div> -->
        </div>
    </section>
    @include('web.components.newsletter')


@endsection