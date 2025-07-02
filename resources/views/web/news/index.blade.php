@extends('web.layouts.master')
@section('title', 'News')
@section('content')
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Latest News</h1>
                <!--  <h2 class="breadcumb-bg-title">News</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">News</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                                                                                    Blog Area
                                                                                    ==============================-->
    <section class="vs-blog-wrapper blog-single-layout1 space-top  newsletter-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($articles as $article)
                        <div class="vs-blog">
                            {{-- Image slider --}}
                            @if ($article->images->count())
                                <div class="blog-image arrow-white vs-carousel" data-slide-show="1" data-arrows="true"
                                    data-prev-arrow="far fa-chevron-left" data-next-arrow="far fa-chevron-right">
                                    @foreach ($article->images as $image)
                                        <a href="{{ route('news.details', $article->slug) }}"><img
                                                src="{{ asset($image->image) }}" class="w-100" alt="Article Image"></a>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Meta info --}}
                            <div class="blog-meta bg-smoke has-border">
                                <a href="#"><i
                                        class="fal fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($article->created_at)->format('F d, Y') }}</a>
                            </div>

                            {{-- Content --}}
                            <div class="blog-content bg-smoke">
                                <h2 class="blog-title h4 font-theme">
                                    <a href="{{ route('news.details', $article->slug) }}">{{ $article->name }}</a>
                                </h2>
                                <p>{{ Str::limit(strip_tags($article->description), 200) }}</p>

                                <div class="author-box d-flex">
                                    <img src="{{ asset($admin?->image) }}" alt="Author Image">
                                    <div class="media-body align-self-center">
                                        <h6 class="name mb-0 text-normal lh-base">
                                            <a href="#">{{ $admin?->name ?? 'Admin' }}</a>
                                        </h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    @include('web.components.newsletter')


@endsection
