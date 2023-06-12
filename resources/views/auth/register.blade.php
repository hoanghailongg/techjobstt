<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - TechJobs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Roboto Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i&display=swap"
          rel="stylesheet">
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- main css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
</head>

<body>
<div class="container-fluid login-fluid clear-left clear-right">
    <div class="login-container">
        <!-- login header -->
        <div class="login-header">
            <div class="w-login m-auto">
                <div class="login-logo">
                    <h3>
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/techjobs_bgw.png') }}" alt="TechJobs">
                        </a>
                    </h3>
                    <span class="login-breadcrumb"><em>/</em> Đăng Ký </span>
                </div>
                <div class="login-right">
                    <a href="{{ route('home') }}" class="btn btn-return">Trang chủ</a>
                </div>
            </div>
        </div>
        <!-- (end) login header -->

        <div class="clearfix"></div>

        <div class="padding-top-90"></div>

        <!-- login main -->
        <div class="login-main">
            <div class="w-login m-auto">
                <div class="row">
                    <!-- login main descriptions -->
                    <div class="col-md-6 col-sm-12 col-12 login-main-left">
                        <img src="{{ asset('img/banner-login.png') }}">
                    </div>
                    <!-- login main form -->
                    <div class="col-md-6 col-sm-12 col-12 login-main-right">

                        <form class="login-form reg-form" action="{{ route('register.store') }}" method="post">
                            @csrf
                            <div class="login-main-header">
                                <h3>Đăng Ký Tài Khoản</h3>
                            </div>
                            <div class="reg-info">
                                <h3>Tài khoản</h3>
                            </div>
                            <div class="input-div one">
                                <div class="div lg-lable">
                                    <h5>Họ và Tên<span class="req">*</span></h5>
                                    <input type="text" class="input form-control-lgin" name="full_name" value="{{ old('full_name') }}">
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="div lg-lable">
                                    <h5>Số điện thoại<span class="req">*</span></h5>
                                    <input type="number" class="input form-control-lgin" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="div lg-lable">
                                    <h5>Địa chỉ email<span class="req">*</span></h5>
                                    <input type="email" class="input form-control-lgin" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="div lg-lable">
                                    <h5>Tên tài khoản<span class="req">*</span></h5>
                                    <input type="text" class="input form-control-lgin" name="username" value="{{ old('username') }}" required>
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="div lg-lable">
                                    <h5>Mật khẩu<span class="req">*</span></h5>
                                    <input type="password" class="input form-control-lgin" name="password" required>
                                </div>
                            </div>
                            <div class="input-div one">
                                <div class="div lg-lable">
                                    <h5>Nhập lại mật khẩu<span class="req">*</span></h5>
                                    <input type="password" class="input form-control-lgin" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group d-block frm-text">
                                <a href="#" class="fg-login d-inline-block"></a>
                                <a href="{{ route('login') }}" class="fg-login float-right d-inline-block">Bạn đã có tài khoản?
                                    Đăng Nhập</a>
                            </div>

                            <input name="submit" type="submit"
                                   class="btn btn-primary float-right btn-login d-block w-100"
                                   value="Đăng ký">

                            <div class="form-group d-block w-100 mt-5">
                                <div class="text-or text-center">
                                    <span>Hoặc</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-12 pr-7">
                                        <a href="{{ route('employer.register') }}" class="text-capitalize font-weight-bold btn btn-warning btnw w-100 float-left">
                                            <span>Đăng ký với tư cách nhà tuyển dụng</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- (end) login main -->
    </div>
</div>
<footer class="login-footer">
    <div class="w-login m-auto">
        <div class="row">
            <!-- login footer left -->
            <div class="col-md-6 col-sm-12 col-12 login-footer-left">
                <div class="login-copyright">
                    <p>Copyright © 2023 <a href="#"> TechJobs</a>. All Rights Reserved.</p>
                </div>
            </div>
            <!-- login footer right -->
            <div class="col-md-6 col-sm-12 col-12 login-footer-right">
                <ul>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
@include('layouts.alert')
</body>

</html>
