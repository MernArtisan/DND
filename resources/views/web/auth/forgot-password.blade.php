@extends('web.layouts.master')
@section('title', 'Forgot Password')
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

        .form-control {
            height: 50px;
            border: 1px solid #e1e1e1;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #d82e2e;
            box-shadow: 0 0 0 0.25rem rgba(216, 46, 46, 0.25);
        }
    </style>

    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">Forgot Password</h1>
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Forgot Password</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="register-section space-top space-md-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="register-form-wrap">
                        <h2 class="register-form-title text-center mb-4">Reset Your Password</h2>

                        @if (session('status'))
                            <div class="alert alert-success text-white bg-success border-0 text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger text-white bg-danger border-0 text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Enter Your Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="you@example.com" required autofocus>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="vs-btn gradient-btn w-100 py-3">Send Reset Link</button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('login.index') }}" class="text-white">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection