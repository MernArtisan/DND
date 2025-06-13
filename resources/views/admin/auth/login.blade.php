<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="{{asset('web/assets/img/favicon.ico')}}">
    <script src="{{asset('admin/assets/js/config.js')}}"></script>
    <link href="{{asset('admin/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>

    <div class="bg-dark d-flex min-vh-100 justify-content-center align-items-center"
        style="background-image: url('{{ asset('web/assets/img/bg/background.jpeg') }}'); background-size: cover; background-position: center;">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card overflow-hidden text-center h-100 p-xxl-4 p-3 mb-0" style="background: #0f1116">
                    <a href="#" class="auth-brand mb-3">
                        <img src="{{asset('web/assets/img/main-logo-1.png')}}" alt="dark logo" height="100"
                            class="logo-dark">
                        <img src="{{asset('admin/assets/images/logo.png')}}" alt="logo light" height="30"
                            class="logo-light">
                    </a>

                    <h4 class="fw-semibold mb-2">Login your account</h4>

                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>

                    <form action="{{route('admin.authenticate')}}" class="text-start mb-3" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="example-email">Email</label>
                            <input type="email" id="example-email" name="email" class="form-control"
                                placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="example-password">Password</label>
                            <input type="password" id="example-password" name="password" class="form-control"
                                placeholder="Enter your password">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif
    </script>



    <script>
        toastr.options = {
            "closeButton": true,  
            "progressBar": true,  
            "positionClass": "toast-top-right", 
            "timeOut": "5000",  
            "extendedTimeOut": "1000"  
        };
    </script>
</body>

</html>