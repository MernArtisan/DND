@extends('web.layouts.master')
@section('title', 'News Details')
@section('content')
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Blog Details</h1>
                <h2 class="breadcumb-bg-title">News</h2>
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Blog Details</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                                    Blog Area
                                    ==============================-->
    <section class="vs-blog-wrapper blog-single-layout1 space-top newsletter-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="vs-blog">
                        {{-- Main Article Image --}}
                        @if ($article->images->isNotEmpty())
                            <div class="blog-image image-scale-hover">
                                <a href="#"><img src="{{ asset($article->images->first()->image) }}" class="w-100"
                                        alt="{{ $article->name }}"></a>
                            </div>
                        @endif

                        {{-- Meta --}}
                        <div class="blog-meta bg-smoke has-border">
                            <a href="#"><i
                                    class="fal fa-calendar-alt"></i>{{ $article->created_at->format('F d, Y') }}</a>
                            {{-- <a href="#"><i class="far fa-comments"></i>0</a> --}}
                            {{-- <div class="cat-list">
                                <i class="far fa-folder-open"></i>
                                <a href="#">News</a>
                            </div> --}}
                        </div>

                        {{-- Content --}}
                        <div class="blog-content bg-smoke">
                            <h2 class="blog-title h4 font-theme"><a href="#">{{ $article->name }}</a></h2>
                            <p>{!! $article->description !!}</p>

                            {{-- More Images --}}
                            @if ($article->images->count() > 1)
                                <div class="row my-25">
                                    @foreach ($article->images->skip(1) as $img)
                                        <div class="col-md-6 mb-30">
                                            <img src="{{ asset('storage/' . $img->image) }}" class="w-100"
                                                alt="Blog Image">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Author Info --}}
                            <div class="blog-written-author d-md-flex bg-smoke px-60 pb-60 pt-55 my-40">
                                <div class="media-img mb-10 mb-md-0 mr-40 align-self-center">
                                    <img src="{{ asset($admin?->image) }}" alt="Blog Author" class="rounded-circle" width="100px">
                                </div>
                                <div class="media-body text-center text-md-start">
                                    <span class="fs-xs text-theme2">Written by</span>
                                    <h3 class="font-theme text-normal mb-1">{{ $admin?->name ?? 'Admin' }}</h3>
                                    <p>{{ $admin?->bio ?? 'Admin of the platform sharing latest updates.' }}</p>
                                </div>
                            </div>


                        </div>

                        {{-- Comment Section (optional static or dynamic setup here) --}}
                        {{-- You can later replace this with dynamic comment model if needed --}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    @include('web.components.newsletter')


@endsection
