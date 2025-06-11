@extends('web.layouts.master')
@section('title', 'Verify OTP')
@section('content')

    <style>
        /* OTP Verification Styles */
        .otp-verification-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .otp-verification-box {
            background: #171920;
            border-radius: 12px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .otp-title {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 10px;
        }

        .otp-subtitle {
            color: #fff;
            font-size: 16px;
        }

        .otp-input-group {
            display: flex;
            justify-content: center;
        }

        .otp-fields {
            display: flex;
            gap: 12px;
        }

        .otp-field {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .otp-field:focus {
            border-color: #d82e2e;
            box-shadow: 0 0 0 3px rgba(216, 46, 46, 0.1);
            outline: none;
        }

        .time-remaining {
            font-size: 15px;
            color: #555;
            margin-bottom: 5px;
        }

        .otp-expired {
            font-size: 15px;
            font-weight: 500;
        }

        .resend-otp {
            color: #666;
            text-decoration: none;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .resend-otp:hover {
            color: #d82e2e;
            text-decoration: none;
        }

        .resend-otp:disabled {
            color: #aaa;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 767px) {
            .otp-verification-box {
                padding: 30px 20px;
            }

            .otp-field {
                width: 40px;
                height: 50px;
                font-size: 20px;
            }

            .otp-fields {
                gap: 8px;
            }
        }
    </style>
    <!--==============================
                Breadcumb
                ============================== -->
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{asset('web/assets/img/breadcumb/breadcumb.jpg')}}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">OTP Code</h1>
                <!--  <h2 class="breadcumb-bg-title">News</h2> -->
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{route('home.index')}}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">OTP Code</li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
                Register OTP Start
                ==============================-->
    <section class="otp-verification-section space-top space-md-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="otp-verification-box">
                        <div class="otp-header text-center mb-5">
                            <h2 class="otp-title">Verify Your Email</h2>
                            <p class="otp-subtitle">We've sent a 6-digit verification code to your email</p>
                        </div>

                        <form class="otp-form" id="otpForm">
                            <div class="otp-input-group mb-4">
                                <div class="otp-fields">
                                    <input type="text" maxlength="1" class="otp-field" data-index="1" autofocus>
                                    <input type="text" maxlength="1" class="otp-field" data-index="2">
                                    <input type="text" maxlength="1" class="otp-field" data-index="3">
                                    <input type="text" maxlength="1" class="otp-field" data-index="4">
                                    <input type="text" maxlength="1" class="otp-field" data-index="5">
                                    <input type="text" maxlength="1" class="otp-field" data-index="6">
                                </div>
                                <input type="hidden" name="otp" id="fullOtp">
                            </div>

                            <div class="otp-timer text-center mb-4">
                                <p class="time-remaining">Time remaining: <span id="countdown">01:00</span></p>
                                <p class="otp-expired text-danger" style="display: none;">OTP has expired!</p>
                            </div>

                            <div class="text-center mb-4">
                                <button type="button" class="btn btn-link resend-otp" id="resendOtp" disabled>
                                    Resend OTP (<span id="resendCountdown">60</span>s)
                                </button>
                            </div>

                            <div class="otp-submit">
                                <button type="submit" class="vs-btn gradient-btn w-100 py-3">Verify & Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpFields = document.querySelectorAll('.otp-field');
            const fullOtpInput = document.getElementById('fullOtp');
            const countdownElement = document.getElementById('countdown');
            const resendCountdownElement = document.getElementById('resendCountdown');
            const resendOtpBtn = document.getElementById('resendOtp');
            const otpExpiredMsg = document.querySelector('.otp-expired');
            const otpForm = document.getElementById('otpForm');

            let timer;
            let secondsLeft = 60;

            // Start the countdown timer
            startTimer();

            // OTP field navigation logic
            otpFields.forEach((field, index) => {
                field.addEventListener('input', function () {
                    const value = this.value;
                    const nextIndex = parseInt(this.getAttribute('data-index')) + 1;

                    // Auto-focus next field
                    if (value && nextIndex <= otpFields.length) {
                        otpFields[nextIndex - 1].focus();
                    }

                    updateFullOtp();
                });

                field.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value) {
                        const prevIndex = parseInt(this.getAttribute('data-index')) - 1;
                        if (prevIndex >= 1) {
                            otpFields[prevIndex - 1].focus();
                        }
                    }
                });
            });

            // Update the hidden full OTP field
            function updateFullOtp() {
                let otp = '';
                otpFields.forEach(field => {
                    otp += field.value;
                });
                fullOtpInput.value = otp;
            }

            // Timer functions
            function startTimer() {
                clearInterval(timer);
                secondsLeft = 60;
                updateTimerDisplay();
                resendOtpBtn.disabled = true;

                timer = setInterval(() => {
                    secondsLeft--;
                    updateTimerDisplay();

                    if (secondsLeft <= 0) {
                        clearInterval(timer);
                        otpExpired();
                        resendOtpBtn.disabled = false;
                        resendOtpBtn.innerHTML = 'Resend OTP';
                    }
                }, 1000);
            }

            function updateTimerDisplay() {
                const minutes = Math.floor(secondsLeft / 60);
                const seconds = secondsLeft % 60;
                countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                resendCountdownElement.textContent = secondsLeft;
            }

            function otpExpired() {
                otpExpiredMsg.style.display = 'block';
                countdownElement.style.display = 'none';
            }

            // Resend OTP functionality
            resendOtpBtn.addEventListener('click', function () {
                if (!this.disabled) {
                    // Here you would typically make an AJAX call to resend OTP
                    alert('New OTP has been sent to your email!');

                    // Reset the UI
                    otpExpiredMsg.style.display = 'none';
                    countdownElement.style.display = 'inline';

                    // Clear OTP fields
                    otpFields.forEach(field => {
                        field.value = '';
                    });
                    fullOtpInput.value = '';
                    otpFields[0].focus();

                    // Restart timer
                    startTimer();
                }
            });

            // Form submission
            otpForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Validate OTP (in a real app, you would verify with server)
                const otp = fullOtpInput.value;
                if (otp.length === 6) {
                    alert('OTP verified successfully!');
                    // window.location.href = "success-page.php"; // Redirect on success
                } else {
                    alert('Please enter a complete 6-digit OTP code');
                }
            });
        });
    </script>
@endsection