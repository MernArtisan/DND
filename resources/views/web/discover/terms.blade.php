@extends('web.layouts.master')
@section('title', 'Corporate Sponsors')
@section('content')

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Terms & Conditions</h1>
                <!-- <h2 class="breadcumb-bg-title">About</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Terms & Conditions</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                    About Area
                    ==============================-->
    <section class="vs-about-wrapper space">
        <div class="container">
            <div class="row flex-lg-row-reverse">
                <div class="col-lg-12">
                    <span class="sub-title2 mb-30">{{ $terms->name }}</span>
                    <p class="fs-18 text-justify">{!! $terms->description !!}</p>
                </div>
            </div>
        </div>
    </section>
    @include('web.components.newsletter')

@endsection