@extends('web.layouts.master')
@section('title', 'Corporate Sponsors')
@section('content')

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Corporate Sponsor</h1>
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Corporate Sponsor</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                Players Area
                ============================== -->
    <section class="vs-member-area vs-member-layout2 space-top newsletter-pb">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($corporateSponsors as $sponsor)
                    <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
                        <div class="image-scale-hover">
                            <div class="member-img">
                                @if (!empty($sponsor->link))
                                    <a href="{{ $sponsor->link }}" target="_blank">
                                        <img src="{{ asset('storage/' . $sponsor->image) }}" class="w-100"
                                            alt="Sponsor Logo">
                                    </a>
                                @else
                                    <img src="{{ asset('storage/' . $sponsor->image) }}" class="w-100" alt="Sponsor Logo">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    @include('web.components.newsletter')

@endsection
