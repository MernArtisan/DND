<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>DND Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.ico')}}">
    <link href="{{asset('admin/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('styles')
</head>

<body>
    <div class="wrapper">
        @include('admin.layouts.sidebar')
        @include('admin.layouts.header')
        @yield('content')
    </div>

    <script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/app.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/pages/dashboard-sales.js')}}"></script>
    <script src="{{asset('admin/assets/js/config.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('scripts')
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success');
        @endif
        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif
    </script>
</body>

</html>