@extends('web.layouts.master')
@section('title', 'Staff')
@section('content')
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Staff</h1>
                <!--  <h2 class="breadcumb-bg-title">Gamers</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
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
                @foreach ($teams as $team)
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="vs-team bg-fluid" data-bg-src="{{ asset('web/assets/img/shape/member-bg-1.png') }}">
                            <div class="team-img mb-35">
                                <a href="#"><img src="{{ asset('web/assets/img/team/staff-1.jpg') }}"
                                        alt="Team Image"></a>
                            </div>
                            <h3 class="team-name h5 text-white mb-0"><a href="#">{{ $team->name }}</a></h3>
                            <span class="team-degi text-light-white fs-xs">{!! $team->description !!}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('web.components.newsletter')


@endsection
