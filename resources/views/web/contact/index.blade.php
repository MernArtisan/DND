@extends('web.layouts.master')
@section('title', 'Corporate Sponsors')
@section('content')

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Contact Us</h1>
                <!--  <h2 class="breadcumb-bg-title">connect</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                Contact Form Area
                ==============================-->
    <section class="vs-contact-wrapper space-top  newsletter-pb">
        <div class="container">
            <div class="row gx-60 mb-30">

                <div class="col-lg-6 mb-30">
                    <span class="sub-title2 mb-20">{{$cms_content[7]->name}}</span>
                    <h2 class="text-normal mb-md-3">{{$cms_content[7]->description}}</h2>
                    <p class="me-xl-4 pe-xl-5">{{$cms_content[7]->item_1}} </p>
                    <h3 class="h4 text-normal pt-xl-2">Opening Hours</h3>
                    <table class="table schedule-table ">
                        <tr>
                            <td><i class="fas fa-calendar-alt"></i> Mon - Fri:</td>
                            <td class="text-end">8.00 am - 8.00 pm</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-alt"></i> Saturday:</td>
                            <td class="text-end">9.00 am - 6.00 pm</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar-alt"></i> Sunday:</td>
                            <td class="text-end">9.00 am - 6.00 pm</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <form action="mail.php" method="POST"
                        class="contact-form contact-form-style1 bg-smoke px-60 py-60 border-0 ">
                        <div class="col-12 mb-30">
                            <h3 class="text-normal mb-2">Send Us a Message</h3>
                            <p class="fs-18">Your email address will not be published*</p>
                        </div>
                        <div class="form-group mb-20">
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name">
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="form-group mb-20">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter Your Email">
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="form-group mb-20">
                            <textarea class="form-control" id="message" rows="5" cols="50" name="message"
                                placeholder="Your Message"></textarea>
                            <i class="fal fa-pencil-alt"></i>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="vs-btn gradient-btn ">Submit Your Quote</button>
                            <p class="form-messages mt-20 mb-0"></p>
                        </div>
                    </form>
                </div>
                <div class="col-12 mt-60">
                    <div class="position-relative">
                        <div class="map-wrap">
                            <div class="google-map" id="google-map"></div>
                        </div> 
                        <div class="info-box3 bg-dark position-absolute start-0 bottom-0 px-40 py-40">
                            <h3 class="h4 text-white text-normal mb-2">Washington DC, Services Center</h3>
                            <p class="text-white"><i class="fas fa-map-marker-alt me-2"></i>301 Massachusetts Ave, Lunenburg
                                MA 1462</p>
                            <div class="row mt-lg-4">
                                <div class="col-sm-6 mb-10 mb-sm-0">
                                    <div class="d-flex">
                                        <span class="icon-btn3 me-3"><i class="fas fa-phone-alt"></i></span>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 text-white font-theme text-normal mb-0">Get In Touch</h4>
                                            <a href="tel:0123456789" class="d-inline-block">85 125 1256 12145</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex">
                                        <span class="icon-btn3 me-3"><i class="fal fa-envelope"></i></span>
                                        <div class="media-body align-self-center">
                                            <h4 class="h5 text-white font-theme text-normal mb-0">Mail Us</h4>
                                            <a href="mailto:info@example.com" class="d-inline-block">info@example.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('web.components.newsletter')

@endsection