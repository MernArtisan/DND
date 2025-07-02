@extends('web.layouts.master')
@section('title', 'Login')
@section('content')


    <style>
        .register-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .register-form-wrap {
            background: #171920;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .register-form-title {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
        }

        .register-form-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #d82e2e;
            margin: 15px auto 0;
        }

        .form-label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 8px;
            display: block;
        }

        .form-control,
        .form-select {
            height: 50px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #d82e2e;
            box-shadow: 0 0 0 0.25rem rgba(216, 46, 46, 0.25);
        }

        .input-group {
            position: relative;
        }
    </style> #

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Login</h1>
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="register-section space-top space-md-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="register-form-wrap">
                        <h2 class="register-form-title text-center mb-4">Enter Your Email</h2>
                        <form id="registrationForm" action="{{ route('login.authenticate') }}" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address*</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="vs-btn gradient-btn w-100 py-3">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('web.components.newsletter') --}}

@endsection
