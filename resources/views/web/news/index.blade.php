@extends('web.layouts.master')
@section('title', 'Home')
@section('content')
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Latest News</h1>
                <!--  <h2 class="breadcumb-bg-title">News</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="index.php"><i class="fal fa-home"></i>Home</a></li>
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
                <div class="col-lg-8">
                    <div class="vs-blog">
                        <div class="blog-image image-scale-hover">
                            <a href="#"><img src="{{asset('web/assets/img/blog/blog-3.jpg')}}" class="w-100"
                                    alt="Blog Image"></a>
                        </div>
                        <div class="blog-meta bg-smoke has-border">
                            <a href="#"><i class="fal fa-calendar-alt"></i>June 20, 2025</a>
                            <a href="#"><i class="far fa-comments"></i>263</a>
                            <div class="cat-list">
                                <i class="far fa-folder-open"></i>
                                <a href="#">e-sports</a>
                                <a href="#">gaming</a>
                                <a href="#">pro</a>
                            </div>
                        </div>
                        <div class="blog-content bg-smoke">
                            <h2 class="blog-title h4 font-theme "><a href="#">Lorem Ipsum dolor Sit Amet</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec dolor velit, mattis quis felis vel, faucibus eleifend risus.
                                Proin nisl sapien, euismod in maximus vitae, porta vitae dolor. </p>
                            <div class="author-box d-flex">
                                <img src="{{asset('web/assets/img/author/author-1.jpg')}}" alt="Author Image">
                                <div class="media-body align-self-center">
                                    <h6 class="name mb-0 text-normal lh-base"><a href="#">David Smith</a></h6>
                                    <span class="fs-xs">250k views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="vs-blog">
                        <div class="blog-image  arrow-white vs-carousel" data-slide-show="1" data-arrows="true"
                            data-prev-arrow="far fa-chevron-left" data-next-arrow="far fa-chevron-right">
                            <a href="#"><img src="{{asset('web/assets/img/blog/blog-2.jpg')}}" class="w-100"
                                    alt="Blog Image"></a>
                            <a href="#"><img src="{{asset('web/assets/img/blog/blog-1.webp')}}" class="w-100"
                                    alt="Blog Image"></a>
                        </div>
                        <div class="blog-meta bg-smoke has-border">
                            <a href="#"><i class="fal fa-calendar-alt"></i>Augest 20, 2025</a>
                            <a href="#"><i class="far fa-comments"></i>263</a>
                            <div class="cat-list">
                                <i class="far fa-folder-open"></i>
                                <a href="#">e-sports</a>
                                <a href="#">gaming</a>
                                <a href="#">pro</a>
                            </div>
                        </div>
                        <div class="blog-content bg-smoke">
                            <h2 class="blog-title h4 font-theme "><a href="#">Lorem ipsum is placeholder text commonly
                                    graphic</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec dolor velit, mattis quis felis vel, faucibus eleifend risus.
                                Proin nisl sapien, euismod in maximus vitae, porta vitae dolor. </p>
                            <div class="author-box d-flex">
                                <img src="{{asset('web/assets/img/author/author-1.jpg')}}" alt="Author Image">
                                <div class="media-body align-self-center">
                                    <h6 class="name mb-0 text-normal lh-base"><a href="#">David Smith</a></h6>
                                    <span class="fs-xs">250k views</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vs-blog">
                        <div class="blog-meta bg-smoke has-border">
                            <a href="#"><i class="fal fa-calendar-alt"></i>July 29, 2025</a>
                            <a href="#"><i class="far fa-comments"></i>263</a>
                            <div class="cat-list">
                                <i class="far fa-folder-open"></i>
                                <a href="#">e-sports</a>
                                <a href="#">gaming</a>
                                <a href="#">pro</a>
                            </div>
                        </div>
                        <div class="blog-content bg-smoke">
                            <h2 class="blog-title h4 font-theme "><a href="#">Lorem ipsum dolor sit amet</a></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec dolor velit, mattis quis felis vel, faucibus eleifend risus.
                                Proin nisl sapien, euismod in maximus vitae, porta vitae dolor. </p>
                            <div class="author-box d-flex">
                                <img src="{{asset('web/assets/img/author/author-1.jpg')}}" alt="Author Image">
                                <div class="media-body align-self-center">
                                    <h6 class="name mb-0 text-normal lh-base"><a href="#">David Smith</a></h6>
                                    <span class="fs-xs">250k views</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="vs-blog">
                        <!--   <div class="blog-audio">
                                                                <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/452578407&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true"></iframe>
                                                            </div> -->
                        <div class="blog-meta bg-smoke has-border">
                            <a href="#"><i class="fal fa-calendar-alt"></i>June 15, 2025</a>
                            <a href="#"><i class="far fa-comments"></i>263</a>
                            <div class="cat-list">
                                <i class="far fa-folder-open"></i>
                                <a href="#">e-sports</a>
                                <a href="#">gaming</a>
                                <a href="#">pro</a>
                            </div>
                        </div>
                        <div class="blog-content bg-smoke">
                            <h2 class="blog-title h4 font-theme "><a href="blog-details.html">Lorem ipsum dolor sit amet</a>
                            </h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dolor velit, mattis quis felis
                                vel, faucibus eleifend risus. Proin nisl sapien, euismod in maximus vitae, porta vitae
                                dolor. </p>
                            <div class="author-box d-flex">
                                <img src="{{asset('web/assets/img/author/author-1.jpg')}}" alt="Author Image">
                                <div class="media-body align-self-center">
                                    <h6 class="name mb-0 text-normal lh-base"><a href="#">David Smith</a></h6>
                                    <span class="fs-xs">250k views</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area sticky-top overflow-hidden">
                        <div class="widget widget_search   ">
                            <form class="search-form">
                                <input type="text" placeholder="Search Here">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <h3 class="sidebox-title-v2 h5">Latest Updates</h3>
                        <div class="vs-sidebox-v2 px-0 pb-0 pt-20 mb-0">
                            <div class="nav nav-fill  tab-menu1 tab-indicator" role="tablist">
                                <a class="nav-link" id="recent-tab" data-bs-toggle="tab" href="#recent" role="tab"
                                    aria-controls="recent" aria-selected="true">Recent</a>
                                <a class="nav-link active" id="popular-tab" data-bs-toggle="tab" href="#popular" role="tab"
                                    aria-controls="popular" aria-selected="false">Popular</a>
                                <a class="nav-link" id="latest-tab" data-bs-toggle="tab" href="#latest" role="tab"
                                    aria-controls="latest" aria-selected="false">latest</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                                <div class="post-thumb-style1 vs-sidebox-v2 pb-1">
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="blog-details.html"><img
                                                    src="{{asset('web/assets/img/widget/recent-news-01.jpg')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="blog-details.html"><img
                                                    src="{{asset('web/assets/img/widget/recent-news-02.jpg')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-03.jpg')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                                <div class="post-thumb-style1 vs-sidebox-v2 pb-1">
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-4.webp')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-5.jpg')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-6.jpg')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet </a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                                <div class="post-thumb-style1 vs-sidebox-v2 pb-1">
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-7.webp')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-8.webp')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-9.jpg')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vs-blog d-flex gap-3">
                                        <div class="media-img news">
                                            <a href="#"><img src="{{asset('web/assets/img/widget/recent-news-10.webp')}}"
                                                    alt="Recent Post"></a>
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 blog-title font-theme lh-base mb-0"><a href="#">Lorem Ipsum Dolor
                                                    Sit Amet</a></h4>
                                            <div class="blog-meta link-inherit fs-xs mt-1">
                                                <a href="#"><i class="fal fa-calendar-alt text-theme2"></i>June 21, 2025</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3 class="sidebox-title-v2 h5">Categories</h3>
                        <div class="vs-sidebox-v2 ">
                            <ul class="vs-cat-list1">
                                <li><a href="#">Rugby <span class="cat-number">10</span></a></li>
                                <li><a href="#">UFC <span class="cat-number">07</span></a></li>
                                <li><a href="#">Football <span class="cat-number">05</span></a></li>
                                <li><a href="#">Snooker <span class="cat-number">02</span></a></li>
                                <li><a href="#">Basketball <span class="cat-number">02</span></a></li>
                            </ul>
                        </div>
                        <h3 class="sidebox-title-v2 h5">Top Games</h3>
                        <div class="vs-sidebox bg-smoke">
                            <div class="row no-gutters g-2">
                                <div class="col-6">
                                    <div class="image-scale-hover sidebox"><a href="#"><img
                                                src="{{asset('web/assets/img/widget/sidebox-news.jpg')}}" class="w-100"
                                                alt="Sidebox Image"></a></div>
                                </div>
                                <div class="col-6">
                                    <div class="image-scale-hover sidebox"><a href="#"><img
                                                src="{{asset('web/assets/img/widget/sidebox-news-1.jpg')}}" class="w-100"
                                                alt="Sidebox Image"></a></div>
                                </div>
                                <div class="col-6">
                                    <div class="image-scale-hover sidebox"><a href="#"><img
                                                src="{{asset('web/assets/img/widget/sidebox-news-2.jpg')}}" class="w-100"
                                                alt="Sidebox Image"></a></div>
                                </div>
                                <div class="col-6">
                                    <div class="image-scale-hover sidebox"><a href="#"><img
                                                src="{{asset('web/assets/img/widget/sidebox-news-5.jpeg')}}" class="w-100"
                                                alt="Sidebox Image"></a></div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @include('web.components.newsletter')


@endsection