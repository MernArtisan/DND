@extends('web.layouts.master')
@section('title', 'Verify OTP')
@section('content')
    <style>
        .vs-pricing {
            position: relative;
            z-index: 4;
        }

        .pricing-box {
            background: #1a1a1a;
            border-radius: 10px;
            padding: 40px 30px;
            position: relative;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            border: 1px solid #2a2a2a;
        }

        .pricing-box.featured {
            border: 1px solid #ff0000;
            transform: translateY(-10px);
        }

        .popular-tag {
            position: absolute;
            top: 0;
            right: 30px;
            background: #ff0000;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 15px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            text-transform: uppercase;
        }

        .pricing-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .pricing-title {
            font-size: 24px;
            color: #fff;
            margin-bottom: 5px;
        }

        .pricing-subtitle {
            color: #aaa;
            font-size: 14px;
        }

        .pricing-price {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #2a2a2a;
        }

        .price {
            font-size: 42px;
            font-weight: 700;
            color: #fff;
        }

        .duration {
            font-size: 16px;
            color: #aaa;
        }

        .pricing-features ul {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        .pricing-features li {
            padding: 8px 0;
            color: #ddd;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .pricing-features li i {
            margin-right: 10px;
            font-size: 12px;
        }

        .pricing-features li.text-muted {
            color: #555;
        }

        .pricing-footer {
            text-align: center;
        }

        .sec-title1price {
            font-size: 36px;
            margin-bottom: 10px;
            color: #000000;
        }

        .sec-text {
            color: #000000;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .pricing-box.featured {
                transform: none;
            }
        }
    </style>
    <!--==============================
        Breadcumb
        ============================== -->
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50" data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}"
        data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Pricing</h1>
                <!--  <h2 class="breadcumb-bg-title">News</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Pricing</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
        Pricing Start
        ==============================-->

    <section class="vs-pricing vs-pricing-layout1 space-top space-md-bottom">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="sec-title1price">{{$cms_content[8]->name}}</h2>
                <p class="sec-text">{{$cms_content[8]->description}}</p>
            </div>

            <div class="row justify-content-center gx-4 gy-30">
                <!-- Basic Plan -->
                <div class="col-md-6 col-lg-4">
                    <div class="pricing-box">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Basic</h3>
                            <p class="pricing-subtitle">For casual sports fans</p>
                        </div>
                        <div class="pricing-price">
                            <span class="price">$5</span>
                            <!-- <span class="duration">/month</span> -->
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fas fa-check text-success"></i> Per Game</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="vs-btn gradient-btn">Get Started</a>
                        </div>
                    </div>
                </div>



                <!-- Family Plan -->
                <div class="col-md-6 col-lg-4">
                    <div class="pricing-box">
                        <div class="pricing-header">
                            <h3 class="pricing-title">Standard</h3>
                            <p class="pricing-subtitle">For dedicated sports enthusiasts</p>
                        </div>
                        <div class="pricing-price">
                            <span class="price">$75</span>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fas fa-check text-success"></i> Per Season</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="vs-btn gradient-btn">Get Started</a>
                        </div>
                    </div>
                </div>
                <!-- Pro Plan (Featured) -->
                <div class="col-md-6 col-lg-4">
                    <div class="pricing-box featured">
                        <div class="popular-tag">MOST POPULAR</div>
                        <div class="pricing-header">
                            <h3 class="pricing-title">Pro</h3>
                            <p class="pricing-subtitle">For the whole household</p>
                        </div>
                        <div class="pricing-price">
                            <span class="price">$150</span>
                            <span class="duration">/unlimited package watch any game any season year round. FULL
                                ACCESS</span>
                        </div>
                        <div class="pricing-features">
                            <ul>
                                <li><i class="fas fa-check text-success"></i> Access to all sports</li>
                                <li><i class="fas fa-check text-success"></i> Ultra HD Quality (4K)</li>
                                <li><i class="fas fa-check text-success"></i> 6 simultaneous streams</li>
                                <li><i class="fas fa-check text-success"></i> VR Support</li>
                                <li><i class="fas fa-check text-success"></i> Offline downloads</li>
                            </ul>
                        </div>
                        <div class="pricing-footer">
                            <a href="#" class="vs-btn gradient-btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection