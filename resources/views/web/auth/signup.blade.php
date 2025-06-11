@extends('web.layouts.master')
@section('title', 'Signup')
@section('content')
    <style>
        /* Register Form Styles */
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

        .phone-code {
            width: 100px;
            border-right: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            flex: 1;
        }

        .gender-options {
            display: flex;
            gap: 20px;
            margin-top: 8px;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 8px;
            margin-top: 0;
        }

        .form-check-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #d82e2e;
            border-color: #d82e2e;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #b82525;
            border-color: #b82525;
            transform: translateY(-2px);
        }

        .form-footer {
            color: #666;
            font-size: 14px;
        }

        .form-footer a {
            color: #d82e2e;
            font-weight: 600;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Phone Input Styles */
        .phone-input-wrapper {
            display: flex;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 0 1px #e1e1e1;
            transition: all 0.3s;
        }

        .phone-input-wrapper:focus-within {
            box-shadow: 0 0 0 2px #d82e2e;
        }

        .country-code-select {
            width: 120px;
            flex-shrink: 0;
        }

        .country-code-select .form-select {
            height: 50px;
            border: none;
            border-radius: 0;
            border-right: 1px solid #e1e1e1;
            padding-right: 5px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
            cursor: pointer;
        }

        .phone-number-input {
            flex: 1;
            height: 50px;
            border: none;
            padding: 0 15px;
            outline: none;
            min-width: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .country-code-select {
                width: 100px;
            }

            .country-code-select .form-select {
                padding-left: 8px;
                font-size: 13px;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 767px) {
            .register-form-wrap {
                padding: 30px 20px;
            }

            .gender-options {
                flex-direction: column;
                gap: 10px;
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
                <h1 class="breadcumb-title h1 text-white my-0">Register</h1>
                <!--  <h2 class="breadcumb-bg-title">News</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="index.php"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
        Register Form Start
        ==============================-->

    <section class="register-section space-top space-md-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="register-form-wrap">
                        <h2 class="register-form-title text-center mb-4">Create Your Account</h2>
                        <form class="register-form" id="register-form" method="post">
                            <div class="row gx-3 gy-1">
                                <!-- Username -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username*</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                </div>

                                <!-- Full Name -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fullname" class="form-label">Full Name*</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address*</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <!--<div class="col-md-10">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number*</label>
                                        <div class="input-group">
                                            <select class="form-select phone-code" name="phonecode" required>
                                                <option value="+1">+1 US</option>
                                                <option value="+44">+44 UK</option>
                                                <option value="+91">+91 IN</option>
                                            </select>
                                            <input type="tel" class="form-control" name="phone" required>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Phone Field -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number*</label>
                                        <div class="phone-input-wrapper">
                                            <div class="country-code-select">
                                                <select class="form-select" name="phonecode" required>
                                                    <option value="+1">+1 (US)</option>
                                                    <option value="+44">+44 (UK)</option>
                                                    <option value="+91">+91 (IN)</option>
                                                    <option value="+971">+971 (UAE)</option>
                                                    <option value="+966">+966 (SA)</option>
                                                </select>
                                            </div>
                                            <input type="tel" class="phone-number-input" name="phone"
                                                placeholder="Enter phone number" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Location Fields -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="country" class="form-label">Country*</label>
                                        <select class="form-select" id="country" name="country" required>
                                            <option value="">Select Country</option>
                                            <option value="US">United States</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="IN">India</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state" class="form-label">State*</label>
                                        <input type="text" class="form-control" id="state" name="state" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city" class="form-label">City*</label>
                                        <input type="text" class="form-control" id="city" name="city" required>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address*</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Gender*</label>
                                        <div class="gender-options">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" checked required>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="female" required>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="other"
                                                    value="other" required>
                                                <label class="form-check-label" for="other">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="vs-btn gradient-btn w-100 py-3">Register Now</button>
                                </div>

                                <!-- Login Link -->
                                <div class="col-12 text-center mt-4">
                                    <p class="form-footer">Already have an account? <a href="login.php"
                                            class="text-primary">Login here</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection