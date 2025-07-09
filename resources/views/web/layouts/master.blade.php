<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="author" content="Vecuro">
    <meta name="robots" content="NOINDEX,NOFOLLOW">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Montserrat:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('web/assets/img/main-logo-1.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('web/assets/img/main-logo-1.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('web/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/layerslider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<style>
    .vs-blog {
        min-height: 400px;
        /* adjust based on content */
    }

    .custom-user-btn {
        min-width: 100px;
        font-size: 15px;
        padding-left: 10px;
        padding-right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    /* Popup Container */
    .popup {
        display: none;
        /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        justify-content: center;
        align-items: center;
        z-index: 1000;
        /* Ensure it's on top */
    }

    /* Popup Content */
    .popup-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 30%;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Close Button */
    .close {
        float: right;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
        background-color: #F30E1B;
        color: #fff;
        border-radius: 50%;
        padding: 10px;
    }

    .close:hover {
        color: #0404e6;
        /* Red color on hover */
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        margin-top: 20px;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .hero-inner .vs-btn.outline1:before {
        background: #F30E1B;
    }

    :root {
        --theme-color: #F30E1B;
        --theme-color2: #F30E1B;
        --theme-color3: #e50a3a;
        --title-color: #000000;
        --body-color: #7c7e90;
        --light-color: #9b9b9b;
        --secondary-color: #f9f9f9;
        --smoke-color: #f8f8f8;
        --dark-color: #0b0c10;
        --light-gray-color: #171920;
        --light-dark-color: #0f1116;
        --mist-blue-color: #686d7c;
        --white-color: #ffffff;
        --black-color: #000000;
        --yellow-color: #fec624;
        --success-color: #28a745;
        --error-color: #dc3545;
        --orange-color: #f07707;
        --border-color: rgba(0, 0, 0, 0.10);
        --theme-font: 'DM Sans', sans-serif;
        --theme-font2: 'Montserrat', sans-serif;
        --theme-font3: 'Roboto', sans-serif;
        --icon-font: 'Font Awesome 5 Pro';
        --ripple-ani-duration: 3s;
        --bs-gutter-x: 15px;
        --bs-gradient: linear-gradient(to right, var(--theme-color2) 0%, var(--theme-color) 100%);
    }

    .hero-layout2 .hero-subtitle {
        background: #F30E1B;
    }

    button[type="submit"] {
        background: #0404e6;
    }

    .vs-team-layout1 .vs-team .team-img img {
        height: 250px;
        object-fit: cover;
    }

    .post-thumb-style1 .media-img.news img {
        height: 90px;
        width: 90px;
        object-fit: cover;
    }

    .image-scale-hover.sidebox img {
        height: 150px;
        width: 175px;
        object-fit: cover;
    }

    .menu-style1>ul>li {
        margin: 21px 4px;
    }

    .member-img {
        margin-bottom: 60px;
    }

    .member-img img {
        height: 165px;
        object-fit: contain;
    }

    h2.my-title {
        font-size: 35px;
    }
</style>

<body>


    @include('web.layouts.header')

    @yield('content')

    @include('web.layouts.footer')



    <a href="#" class="scrollToTop icon-btn3"><i class="far fa-angle-up"></i></a>

    <div class="vs-cursor"></div>
    <div class="vs-cursor2"></div>


    <script src="{{ asset('web/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vscustom-carousel.min.js') }}"></script>

    <script src="{{ asset('web/assets/js/vs-cursor.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vsmenu.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2zcZWYTrnjovVYwCR9zwHJwVEtUEufJk&libraries=places">
    </script>
    <script src="{{ asset('web/assets/js/map.js') }}"></script>
    <script src="{{ asset('web/assets/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('web/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('newsletterForm');
            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                    .then(async response => {
                        if (!response.ok) {
                            const errorData = await response.json();
                            const errors = errorData.errors?.email || ['Something went wrong.'];
                            throw new Error(errors[0]);
                        }
                        return response.json();
                    })
                    .then(data => {
                        toastr.success(data.message || 'You have successfully subscribed.');
                        form.reset();
                    })
                    .catch(error => {
                        console.error(error);
                        toastr.error(error.message || 'Something went wrong.');
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.contact-form');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const formData = new FormData(form);
                    const messageBox = form.querySelector('.form-messages');
                    messageBox.innerText = '';
                    messageBox.classList.remove('text-success', 'text-danger');

                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                        .then(async res => {
                            if (!res.ok) {
                                const errorData = await res.json();
                                const errors = errorData.errors || { general: ['Something went wrong.'] };
                                const firstError = Object.values(errors)[0][0];
                                throw new Error(firstError);
                            }
                            return res.json();
                        })
                        .then(data => {
                            toastr.success(data.message || 'You have successfully subscribed.');
                            form.reset();
                        })
                        .catch(error => {
                            console.error(error);
                            toastr.error(error.message || 'Something went wrong.');
                        });
                });
            });
        });
        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success');
        @endif
        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif
    </script>

    @yield('js')

</body>

</html>