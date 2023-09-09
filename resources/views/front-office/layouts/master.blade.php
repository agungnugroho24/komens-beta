<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q2QNQ1GDP7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
 
    gtag('config', 'G-Q2QNQ1GDP7');
  </script>
  
  @include('front-office.partials.header')
  @stack('app-styles')

</head>

<body>

  <!-- ======= Header ======= -->
  @yield('navbar-header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @yield('section-title-header')
  <!-- End Hero -->

  <main id="main">
    @yield('content')
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('front-office.partials.top_footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top bounce-arrow d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  @include('front-office.partials.footer')
  @stack('app-script')

</body>

</html>