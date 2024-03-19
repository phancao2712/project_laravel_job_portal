<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>General Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
    <script src="https://kit.fontawesome.com/c9111ed195.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset("admin/assets/modules/bootstrap-daterangepicker/daterangepicker.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/assets/modules/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/assets/modules/fontawesome/css/all.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/assets/modules/select2/dist/css/select2.min.css") }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset("admin/assets/modules/summernote/summernote-bs4.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/assets/css/bootstrap-iconpicker.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css") }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset("admin/assets/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/assets/css/components.css") }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <!-- Nav -->
            @include('admin.layouts.nav')

            <!-- Sidebar -->
            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('contents')
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset("admin/assets/modules/tooltip.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/nicescroll/jquery.nicescroll.min.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/moment.min.js") }}"></script>
    <script src="{{ asset("admin/assets/js/stisla.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/select2/dist/js/select2.full.min.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/bootstrap-daterangepicker/daterangepicker.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js") }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset("admin/assets/js/bootstrap-iconpicker.bundle.min.js") }}"></script>
    <script src="{{ asset("admin/assets/modules/sweetalert/sweetalert.min.js") }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>


    <!-- Template JS File -->
    <script src="{{ asset("admin/assets/js/scripts.js") }}"></script>
    <script src="{{ asset("admin/assets/js/custom.js") }}"></script>
    @stack('script')

</body>

</html>
