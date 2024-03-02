<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{ env("APP_URL") }}frontend/">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="msapplication-TileColor" content="#0E0E0E">
  <meta name="template-color" content="#0E0E0E">
  <link rel="manifest" href="manifest.json" crossorigin>
  <meta name="msapplication-config" content="browserconfig.xml">
  <meta name="description" content="Index page">
  <meta name="keywords" content="index, page">
  <meta name="author" content="">
  <link rel="shortcut icon" type="image/x-icon" href="">
  <link href="assets/css/all.min.css" rel="stylesheet">
  @notifyCss
  <link href="assets/css/style.css" rel="stylesheet">
  <title>joblist - Job Portal HTML Template </title>
</head>

<body>

    @include('frontend.layouts.header')

  <main class="main">

    @yield('contents')

  </main>

  @include('frontend.layouts.sub_box')

  @include('frontend.layouts.footer')

  <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
  <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
  <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
  <script src="assets/js/plugins/waypoints.js"></script>
  <script src="assets/js/plugins/wow.js"></script>
  <script src="assets/js/plugins/magnific-popup.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/select2.min.js"></script>
  <script src="assets/js/plugins/isotope.js"></script>
  <script src="assets/js/plugins/scrollup.js"></script>
  <script src="assets/js/plugins/swiper-bundle.min.js"></script>
  <script src="assets/js/plugins/Font-Awesome.js"></script>
  <script src="assets/js/plugins/counterup.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
  <x-notify::notify />
@notifyJs
  <script src="assets/js/main.js?v=4.1"></script>
  <script src="assets/js/custom.js"></script>

{{-- SCRIPT --}}
@stack('script')

</body>

</html>
