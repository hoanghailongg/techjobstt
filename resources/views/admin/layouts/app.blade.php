<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ !isset($title) ? 'Quản lý hệ thống' : $title }} | {{config('app.name', 'TechJobs')}}</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('manage/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('manage/dist/css/adminlte.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('manage/plugins/toastr/toastr.min.css')}}">
    <!-- Customize style -->
    <link rel="stylesheet" href="{{ asset('manage/dist/css/custom.css') }}">
    <!-- Theme style push -->
    @stack('stylesheets')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('manage/img/AdminLTELogo.png')}}" alt="{{config('app.name')}}" height="60" width="60">
    </div>
    <!-- Navbar -->
    @include('admin.layouts.nav')
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('admin.layouts.footer')
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{ asset('manage/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('manage/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('manage/dist/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{asset('manage/plugins/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('manage/dist/js/demo.js') }}"></script>
<!-- REQUIRED SCRIPTS -->
<!-- Customize -->
<script src="{{ asset('manage/dist/js/custom.js') }}"></script>
@stack('scripts')
<!-- Notify -->
@include('admin.layouts.alert')
</body>
</html>
