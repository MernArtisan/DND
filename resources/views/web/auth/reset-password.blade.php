@extends('web.layouts.master')
@section('title', 'Reset Password')
@section('content')

    <style>
        .reset-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .reset-form-wrap {
            background: #171920;
            border-radius: 10px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .reset-title {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 30px;
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
                <h1 class="breadcumb-title h1 text-white my-0">Reset Password</h1>
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Reset Password</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="reset-section space-top space-md-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="reset-form-wrap">
                        <h2 class="reset-title text-center">Reset Your Password</h2>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="form-group mb-4">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password_confirmation" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="vs-btn gradient-btn w-100 py-3">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection