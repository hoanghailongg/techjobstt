<?php

use Illuminate\Support\Facades\Auth;

?>

@include('layouts.header')

<body>
<!-- main nav -->
@if(isset($layout) && $layout == 'home')
    @include('layouts.home-nav')
@else
    @include('layouts.main-nav')
@endif
<!-- (end) main nav -->

<div class="clearfix"></div>


@yield('content')

<!-- job support -->
<div class="container-fluid job-support-wrapper">
    <div class="container-fluid job-support-wrap">
        <div class="container job-support">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-12">
                    <ul class="spp-list">
                        <li>
                            <span><i class="fa fa-question-circle pr-2 icsp"></i>Hỗ trợ nhà tuyển dụng:</span>
                        </li>
                        <li>
                            <span><i class="fa fa-phone pr-2 icsp"></i>0352.673.466</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="newsletter">
                        <span class="txt6">Đăng ký nhận bản tin việc làm</span>
                        <div class="input-group frm1">
                            <input type="text" placeholder="Nhập email của bạn" class="newsletter-email form-control">
                            <a href="../#" class="input-group-addon"><i class="fa fa-lg fa-envelope-o colorb"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- (end) job support -->

<!-- footer -->
<div class="container-fluid footer-wrap  clear-left clear-right">
    <div class="container footer">
        <div class="row">
            <div class="col-md-4 col-sm-8 col-12">
                <h2 class="footer-heading">
                    <span>About</span>
                </h2>
                <p class="footer-content">
                    Techjobstt.site
                </p>
                <ul class="footer-contact">
                    <li>
                        <a href="../#">
                            <i class="fa fa-phone fticn"></i> +843 .526 .73466
                        </a>
                    </li>
                    <li>
                        <a href="../#">
                            <i class="fa fa-envelope fticn"></i>
                            manhdat5302@gmail.com
                        </a>
                    </li>
                    <li>
                        <a href="../#">
                            <i class="fa fa-map-marker fticn"></i>
                            Học Viện, Nông nghiệp, Trâu Quỳ, Gia Lâm, HN
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-4 col-12">
                <h2 class="footer-heading">
                    <span>Ngôn ngữ nổi bật</span>
                </h2>
                <ul class="footer-list">
                    <li><a href="../#">Javascript</a></li>
                    <li><a href="../#">Java</a></li>
                    <li><a href="../#">Frontend</a></li>
                    <li><a href="../#">SQL Server</a></li>
                    <li><a href="../#">.NET</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                <h2 class="footer-heading">
                    <span>Tất cả ngành nghề</span>
                </h2>
                <ul class="footer-list">
                    <li><a href="../#">Lập trình viên</a></li>
                    <li><a href="../#">Kiểm thử phần mềm</a></li>
                    <li><a href="../#">Kỹ sư cầu nối</a></li>
                    <li><a href="../#">Quản lý dự án</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                <h2 class="footer-heading">
                    <span>Tất cả hình thức</span>
                </h2>
                <ul class="footer-list">
                    <li><a href="../#">Nhân viên chính thức</a></li>
                    <li><a href="../#">Nhân viên bán thời gian</a></li>
                    <li><a href="../#">Freelancer</a></li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-12 col-12">
                <h2 class="footer-heading">
                    <span>Tất cả tỉnh thành</span>
                </h2>
                <ul class="footer-list">
                    <li><a href="../#">Hồ Chính Minh</a></li>
                    <li><a href="../#">Hà Nội</a></li>
                    <li><a href="../#">Đà Nẵng</a></li>
                    <li><a href="../#">Buôn Ma Thuột</a></li>
                </ul>
            </div>


        </div>
    </div>
</div>

<footer class="container-fluid copyright-wrap">
    <div class="container copyright">
        <p class="copyright-content">
            Copyright © 2023 <a href="../#"> Tech<b>Job</b></a>. All Right Reserved.
        </p>
    </div>
</footer>


<!-- (end) footer -->

<script type="text/javascript" src="{{ asset('js/readmore.js') }}"></script>
<script type="text/javascript">
    $('.catelog-list').readmore({
        speed: 75,
        maxHeight: 150,
        moreLink: '<a href="../#">Xem thêm<i class="fa fa-angle-down pl-2"></i></a>',
        lessLink: '<a href="../#">Rút gọn<i class="fa fa-angle-up pl-2"></i></a>'
    });
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/jobdata.js') }}"></script>

<!-- Owl Stylesheets Javascript -->
<script src="{{ asset('js/owlcarousel/owl.carousel.js') }}"></script>
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
@stack('scripts')
<!-- Read More Plugin -->
@include('layouts.alert')

</body>
</html>
