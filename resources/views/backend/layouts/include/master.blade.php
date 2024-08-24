<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>real time chat app</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- jquery --}}
  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  {{-- Select2  --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Favicons -->
  <link href="{{ asset('admin') }}/assets/img/favicon.png" rel="icon">
  <link href="{{ asset('admin') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="{{ asset('admin') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('admin') }}/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


  {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->

@include('backend.layouts.include.header')

  <!-- ======= Sidebar ======= -->
  @include('backend.layouts.include.sidebar')
  <main id="main" class="main">

    @yield('content')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  {{-- @include('backend.layouts.include.footer') --}}

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="{{ asset('admin') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('admin') }}/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('admin') }}/assets/js/main.js"></script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
  {!! Toastr::message() !!}
   @stack('js')
</body>
</html>
