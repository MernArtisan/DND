@extends('web.layouts.master')
@section('title', 'Channels')
@section('content')

    <style>
        /* Live Channels Styles */
        .vs-live-stream {
            position: relative;
            z-index: 4;
        }

        .live-channel {
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .live-channel:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .channel-thumb {
            position: relative;
            overflow: hidden;
        }

        .channel-thumb img {
            transition: all 0.5s ease;
            height: 180px;
            object-fit: cover;
        }

        .live-channel:hover .channel-thumb img {
            transform: scale(1.05);
        }

        .channel-label {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff0000;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 4px;
            text-transform: uppercase;
            z-index: 2;
        }

        .channel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 0.4s ease;
            padding: 15px;
        }

        .live-channel:hover .channel-overlay {
            opacity: 1;
        }

        .channel-title {
            color: #fff;
            font-size: 18px;
            margin-bottom: 5px;
            text-align: center;
        }

        .channel-desc {
            color: #ddd;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
        }

        .channel-info {
            padding: 12px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #222;
        }

        .channel-viewers {
            color: #aaa;
            font-size: 12px;
        }

        .channel-viewers i {
            margin-right: 5px;
            color: #ff0000;
        }

        .channel-category {
            color: #fff;
            font-size: 12px;
            background: rgba(255, 255, 255, 0.1);
            padding: 3px 8px;
            border-radius: 4px;
        }

        .sec-title1live {
            font-size: 36px;
            margin-bottom: 10px;
            color: #000;
        }

        .sec-text {
            color: #000000;
            max-width: 600px;
            margin: 0 auto 30px;
        }
    </style>
    <!--==============================
                                Breadcumb
                                ============================== -->
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Live Stream Channels</h1>
                <!--  <h2 class="breadcumb-bg-title">News</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Live Stream Channels</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                                Live Stream Channels Start
                                ==============================-->

    <section class="vs-live-stream vs-live-stream-layout1 space-top space-md-bottom">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="sec-title1live">{{$cms_content[6]->name}}</h2>
                <p class="sec-text">{{$cms_content[6]->description}}</p>
            </div>

            <div class="row gx-4 gy-30">
                <!-- Channel 1 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Sports Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Sports HD</h3>
                                <p class="channel-desc">Live matches & tournaments</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 12.5K watching</span>
                            <span class="channel-category">Sports</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 2 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Movies Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Movie Premiere</h3>
                                <p class="channel-desc">Blockbuster movies 24/7</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 8.2K watching</span>
                            <span class="channel-category">Entertainment</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 3 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="News Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Global News</h3>
                                <p class="channel-desc">Breaking news worldwide</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 5.7K watching</span>
                            <span class="channel-category">News</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 4 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Music Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Hits FM</h3>
                                <p class="channel-desc">Latest music videos</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 9.1K watching</span>
                            <span class="channel-category">Music</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 5 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Kids Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Cartoon World</h3>
                                <p class="channel-desc">Fun for kids</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 3.4K watching</span>
                            <span class="channel-category">Kids</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 6 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Documentary Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Discovery+</h3>
                                <p class="channel-desc">Amazing documentaries</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 4.8K watching</span>
                            <span class="channel-category">Education</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 7 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Cooking Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Food Network</h3>
                                <p class="channel-desc">Delicious recipes</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 2.9K watching</span>
                            <span class="channel-category">Lifestyle</span>
                        </div>
                    </div>
                </div>

                <!-- Channel 8 -->
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="live-channel">
                        <div class="channel-thumb">
                            <img src="{{asset('web/assets/img/blog/news-1.jpg')}}" alt="Tech Channel" class="w-100">
                            <div class="channel-label">LIVE</div>
                            <div class="channel-overlay">
                                <h3 class="channel-title">Tech Today</h3>
                                <p class="channel-desc">Latest gadget reviews</p>
                                <a href="{{route('liveStreams.index')}}" class="vs-btn style3">Watch Now</a>
                            </div>
                        </div>
                        <div class="channel-info">
                            <span class="channel-viewers"><i class="fas fa-eye"></i> 6.3K watching</span>
                            <span class="channel-category">Technology</span>
                        </div>
                    </div>
                </div>
            </div>

            <!--  <div class="text-center mt-50">
                                        <a href="#" class="vs-btn style2">View All Channels</a>
                                    </div> -->
        </div>
    </section>
    @include('web.components.newsletter')

@endsection