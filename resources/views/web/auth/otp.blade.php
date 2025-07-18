@extends('web.layouts.master')
@section('title', 'Verify OTP')
@section('content')

    <style>
        .otp-verification-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .otp-verification-box {
            background: #171920;
            border-radius: 12px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
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
            color: #ccc;
            margin-bottom: 5px;
        }

        .otp-expired {
            font-size: 15px;
            font-weight: 500;
        }

        .resend-otp {
            color: #aaa;
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
            color: #777;
            cursor: not-allowed;
        }

        /* Spinner overlay */
        .otp-overlay-spinner {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
            display: none;
            justify-content: center;
            align-items: center;
            border-radius: 12px;
        }

        .otp-overlay-spinner.active {
            display: flex;
        }

        /* Blur when spinner shows */
        .otp-blur {
            filter: blur(3px);
            pointer-events: none;
            opacity: 0.6;
        }

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

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-4px);
            }

            40%,
            80% {
                transform: translateX(4px);
            }
        }

        .otp-shake .otp-field {
            animation: shake 0.4s ease;
            border-color: red;
        }
    </style>

    <!-- Breadcrumb -->
    <div class="breadcumb-wrapper breadcumb-layout1 pt-200 pb-50"
        data-bg-src="{{ asset('web/assets/img/breadcumb/breadcumb.jpg') }}" data-overlay>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center">
                <h1 class="breadcumb-title h1 text-white my-0">OTP Code</h1>
                <ul class="breadcumb-menu-style1 text-white mx-auto fs-xs">
                    <li><a href="{{ route('home.index') }}"><i class="fal fa-home"></i>Home</a></li>
                    <li class="active">OTP Code</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- OTP Form -->
    <section class="otp-verification-section space-top space-md-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="otp-verification-box">
                        <div class="otp-header text-center mb-5">
                            <h2 class="otp-title">Verify Your Email</h2>
                            <p class="otp-subtitle">We've sent a 4-digit verification code to your email</p>
                        </div>

                        <form class="otp-form" id="otpForm" method="POST" action="{{ route('verifyOtp.submit') }}">
                            @csrf

                            <!-- Spinner Overlay -->
                            <div class="otp-overlay-spinner" id="resendSpinner">
                                <div class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <!-- OTP Form Content -->
                            <div id="otpWrapper">
                                <div class="otp-input-group mb-4">
                                    <div class="otp-fields">
                                        <input type="text" maxlength="1" class="otp-field" data-index="1" autofocus>
                                        <input type="text" maxlength="1" class="otp-field" data-index="2">
                                        <input type="text" maxlength="1" class="otp-field" data-index="3">
                                        <input type="text" maxlength="1" class="otp-field" data-index="4">
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
                                    <button type="submit" class="vs-btn gradient-btn w-100 py-3" id="verifyBtn">Verify &
                                        Continue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpFields = document.querySelectorAll('.otp-field');
            const fullOtpInput = document.getElementById('fullOtp');
            const countdownElement = document.getElementById('countdown');
            const resendCountdownElement = document.getElementById('resendCountdown');
            const resendOtpBtn = document.getElementById('resendOtp');
            const otpExpiredMsg = document.querySelector('.otp-expired');
            const otpForm = document.getElementById('otpForm');
            const fieldsContainer = document.querySelector('.otp-fields');
            const otpWrapper = document.getElementById('otpWrapper');
            const resendSpinner = document.getElementById('resendSpinner');

            let timer;
            let secondsLeft = 0;

            const otpExpiryTimestamp = {{ $otpExpiryTimestamp ?? 'null' }};
            const now = Date.now();

            if (!otpExpiryTimestamp || now >= otpExpiryTimestamp) {
                otpExpiredMsg.style.display = 'block';
                countdownElement.style.display = 'none';
                resendOtpBtn.disabled = false;
                resendOtpBtn.innerText = 'Resend OTP';
                localStorage.removeItem('otp_expiry');
            } else {
                secondsLeft = Math.floor((otpExpiryTimestamp - now) / 1000);
                localStorage.setItem('otp_expiry', otpExpiryTimestamp);
                startTimer();
            }

            function startTimer() {
                clearInterval(timer);
                updateTimerDisplay();
                resendOtpBtn.disabled = true;

                timer = setInterval(() => {
                    secondsLeft--;
                    updateTimerDisplay();

                    if (secondsLeft <= 0) {
                        clearInterval(timer);
                        otpExpiredMsg.style.display = 'block';
                        countdownElement.style.display = 'none';
                        resendOtpBtn.disabled = false;
                        resendOtpBtn.innerText = 'Resend OTP';
                        localStorage.removeItem('otp_expiry');
                    }
                }, 1000);
            }

            function updateTimerDisplay() {
                const minutes = Math.floor(secondsLeft / 60);
                const seconds = secondsLeft % 60;
                countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                resendCountdownElement.textContent = secondsLeft;
            }

            resendOtpBtn.addEventListener('click', function () {
                if (!this.disabled) {
                    resendSpinner.classList.add('active');
                    otpWrapper.classList.add('otp-blur');

                    fetch("{{ route('resend.otp') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            toastr.success(data.message || 'OTP resent successfully.');
                            otpExpiredMsg.style.display = 'none';
                            countdownElement.style.display = 'inline';
                            otpFields.forEach(field => field.value = '');
                            fullOtpInput.value = '';
                            otpFields[0].focus();

                            secondsLeft = 60;
                            const newExpiry = Date.now() + 60000;
                            localStorage.setItem('otp_expiry', newExpiry);
                            startTimer();
                        })
                        .catch(() => {
                            alert('Failed to resend OTP.');
                        })
                        .finally(() => {
                            resendSpinner.classList.remove('active');
                            otpWrapper.classList.remove('otp-blur');
                        });
                }
            });

            otpFields.forEach((field, index) => {
                field.addEventListener('input', function () {
                    const nextIndex = parseInt(this.dataset.index) + 1;
                    if (this.value && nextIndex <= otpFields.length) {
                        otpFields[nextIndex - 1].focus();
                    }
                    updateFullOtp();
                });

                field.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value) {
                        const prevIndex = parseInt(this.dataset.index) - 1;
                        if (prevIndex >= 1) {
                            otpFields[prevIndex - 1].focus();
                        }
                    }
                });
            });

            function updateFullOtp() {
                let otp = '';
                otpFields.forEach(field => {
                    otp += field.value;
                });
                fullOtpInput.value = otp;
            }

            otpForm.addEventListener('submit', function () {
                document.getElementById('verifyBtn').disabled = true;
            });

            fieldsContainer.classList.add('otp-shake');
            setTimeout(() => fieldsContainer.classList.remove('otp-shake'), 400);
        });
    </script>

@endsection