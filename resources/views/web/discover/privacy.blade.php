@extends('web.layouts.master')
@section('title', 'Corporate Sponsors')
@section('content')

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50" data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}"
        data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Privacy Policy</h1>
               <!-- <h2 class="breadcumb-bg-title">About</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Privacy Policy</li>
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
                    <span class="sub-title2 mb-30">Privacy Policy</span>
                    <h2 class="sec-title1 my-title mb-15">Lorem Ipsum</h2>
                    <p class="fs-18 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Suspendisse condimentum vulputate pellentesque. Aenean a faucibus dolor, 
                    vitae hendrerit elit. Proin sollicitudin dignissim velit, in rhoncus elit sollicitudin nec.
                    Nullam faucibus risus eget tellus semper semper. Maecenas posuere gravida erat vitae aliquet.
                    Vestibulum purus erat, sagittis sed rhoncus sed, semper ut sem.</p>
                </div>
                <div class="col-lg-12">
                    <h2 class="sec-title1 my-title mb-15">Lorem Ipsum</h2>
                    <p class="fs-18 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Suspendisse condimentum vulputate pellentesque. Aenean a faucibus dolor, 
                    vitae hendrerit elit. Proin sollicitudin dignissim velit, in rhoncus elit sollicitudin nec.
                    Nullam faucibus risus eget tellus semper semper. Maecenas posuere gravida erat vitae aliquet.
                    Vestibulum purus erat, sagittis sed rhoncus sed, semper ut sem.</p>
                </div>
                <div class="col-lg-12">
                    <h2 class="sec-title1 my-title mb-15">Lorem Ipsum</h2>
                    <p class="fs-18 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Suspendisse condimentum vulputate pellentesque. Aenean a faucibus dolor, 
                    vitae hendrerit elit. Proin sollicitudin dignissim velit, in rhoncus elit sollicitudin nec.
                    Nullam faucibus risus eget tellus semper semper. Maecenas posuere gravida erat vitae aliquet.
                    Vestibulum purus erat, sagittis sed rhoncus sed, semper ut sem.</p>
                    <ul class="about-list fs-18 list-style-none mb-35">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <h2 class="sec-title1 my-title mb-15">Lorem Ipsum</h2>
                    <p class="fs-18 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Suspendisse condimentum vulputate pellentesque. Aenean a faucibus dolor, 
                    vitae hendrerit elit. Proin sollicitudin dignissim velit, in rhoncus elit sollicitudin nec.
                    Nullam faucibus risus eget tellus semper semper. Maecenas posuere gravida erat vitae aliquet.
                    Vestibulum purus erat, sagittis sed rhoncus sed, semper ut sem.</p>
                    <ul class="about-list fs-18 list-style-none mb-35">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <h2 class="sec-title1 my-title mb-15">Lorem Ipsum</h2>
                    <p class="fs-18 text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Suspendisse condimentum vulputate pellentesque. Aenean a faucibus dolor, 
                    vitae hendrerit elit. Proin sollicitudin dignissim velit, in rhoncus elit sollicitudin nec.
                    Nullam faucibus risus eget tellus semper semper. Maecenas posuere gravida erat vitae aliquet.
                    Vestibulum purus erat, sagittis sed rhoncus sed, semper ut sem.</p>
                    <ul class="about-list fs-18 list-style-none mb-35">
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    @include('web.components.newsletter')

@endsection