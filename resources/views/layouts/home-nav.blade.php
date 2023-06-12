<div class="container-fluid fluid-nav">
    <div class="container cnt-tnar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light tjnav-bar">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('img/techjobs_bgb.png') }}">
            </a>
            <button class="navbar-toggler tnavbar-toggler"
                    type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <i class="fa fa-bars icn-res" aria-hidden="true"></i>

            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto tnav-left tn-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.search') }}">Việc Làm IT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://careerbuilder.vn/">Tin Tức</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto my-2 my-lg-0 tnav-right tn-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('jobs.search') }}">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <span class="hidden-text">Tìm kiếm</span>
                        </a>
                    </li>

                    @if(Auth::check() || Auth::guard('admin')->check())
                        @php
                            $name = Auth::user()->username ?? Auth::guard('admin')->user()->username ?? Auth::guard('employer')->user()->full_name;
                            $urlProfile = route('profile');
                            $textUrl = 'Trang cá nhân';
                            if (Auth::guard('admin')->check()) {
                                $urlProfile = route('admin.dashboard');
                                $textUrl = 'Trang quản trị';
                            } else if (Auth::guard('employer')->check()) {
                                $urlProfile = route('employer.dashboard');
                                $textUrl = 'Trang quản trị';
                            }
                        @endphp
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="../#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Xin chào, {{ $name }}</a>
                            <div class="dropdown-menu tdropdown" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ $urlProfile }}">{{ $textUrl }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                            </div>
                        </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="{{ route('register') }}">Đăng Ký</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="{{ route('login') }}">Đăng Nhập</a>
                    </li>
                    @endif

                    @if(auth()->guard('admin')->check())
                    <li class="nav-item">
                        <a class="nav-link btn-employers" href="{{ route('admin.dashboard') }}" tabindex="-1" aria-disabled="true">Nhà Tuyển Dụng</a>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
