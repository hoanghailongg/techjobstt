@extends('layouts.app' , ['layout' => 'home'])

@section('stylesheets')
    <style>
        .search-wrapper {
            margin-top: -11rem;
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            border-bottom: 1px solid #fff;
            color: #fff;
        }
        .news-details .title a {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
@endsection

@section('content')
    <!-- main banner -->
    <div class="container-fluid clear-left clear-right">
        <div class="main-banner">
            <div class="banner-image">
                <img src="{{ asset('img/banner2.jpg') }}" alt="banner-image">
            </div>
        </div>
        <div class="banner-content">
            <h3>1000+ Jobs For Developers</h3>
            <div class="banner-tags">
                <ul>
                    <li><a href="../#">Java</a></li>
                    <li><a href="../#">Python</a></li>
                    <li><a href="../#">Tester</a></li>
                    <li><a href="../#">QA QC</a></li>
                    <li><a href="../#">.NET</a></li>
                    <li><a href="../#">Javascript</a></li>
                    <li><a href="../#">Business Analyst</a></li>
                    <li><a href="../#">Designer</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- (end) main banner -->
    @include('layouts.search-section')
    <!-- job board & sidebar section  -->
    <div class="container-fluid jb-wrapper">
        <div class="container">
            <div class="row">
                <!-- job board -->
                <div class="col-md-8 col-sm-12 col-12">
                    <div class="job-board-wrap">
                        <h2 class="widget-title">
                            <span>Tuyển gấp</span>
                        </h2>
                        <div class="job-group">
                            @foreach($jobs as $key => $job)
                                <div class="job pagi">
                                    <div class="job-content">
                                        <div class="job-logo">
                                            <a href="{{ route('view.job', ['job' => $job->id]) }}">
                                                <img src="{{ $job->company->avatar ? asset($job->company->avatar) : asset('img/icon_avatar.jpg') }}" class="job-logo-ima"
                                                     alt="job-logo">
                                            </a>
                                        </div>

                                        <div class="job-desc">
                                            <div class="job-title">
                                                <a href="{{ route('view.job', ['job' => $job->id]) }}">{{ $job->title }}</a>
                                            </div>
                                            <div class="job-company">
                                                <a href="{{ route('view.job', ['job' => $job->id]) }}">{{ $job->company->name }}</a>|
                                                <a href="{{ route('view.job', ['job' => $job->id]) }}" class="job-address">
                                                    <i class="fa fa-map-marker"
                                                        aria-hidden="true"></i> {{ $job->city->name }}</a>
                                            </div>

                                            <div class="job-inf">
                                                <div class="job-main-skill">
                                                    @php
                                                        $languages = $job->language_names;
                                                    @endphp
                                                    <i class="fa fa-code" aria-hidden="true"></i> <a
                                                        href="{{ route('view.job', ['job' => $job->id]) }}"> {{ !empty($languages) ? trim(explode(',', $languages)[0]) : '' }}</a>
                                                </div>
                                                <div class="job-salary">
                                                    <i class="fa fa-money" aria-hidden="true"></i>
                                                    <span class="salary-min">{{ $job->salary_start }}<em class="salary-unit">$</em></span>
                                                    <span class="salary-max">{{ $job->salary_end }}<em class="salary-unit">$</em></span>
                                                </div>
                                                <div class="job-deadline">
                                                    <span><i class="fa fa-clock-o"
                                                             aria-hidden="true"></i>  Hạn nộp: <strong>{{ date('d-m-Y', strtotime($job->date_end)) }}</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wrap-btn-appl">
                                            <a href="{{ route('view.job', ['job' => $job->id]) }}" class="btn btn-appl">Apply
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="readmorestyle-wrap">
                                <a href="../#" class="readallstyle reads1">Xem tất cả</a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- (end) job board -->
                <!-- sidebar -->
                <div class="col-md-4 col-sm-12 col-12 clear-left">
                    <div class="job-sidebar">
                        <h2 class="widget-title">
                            <span>Ngành Nghề</span>
                        </h2>
                        <div class="catelog-list">
                            <ul>
                                <li>
                                    <a href="../#">
                                        <span class="cate-img">
                                          <em>Lập trình viên</em>
                                        </span>
                                        <span class="cate-count">(1100)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../#">
                                        <span class="cate-img">
                                          <em>Nhân viên kiểm thử</em>
                                        </span>
                                        <span class="cate-count">(230)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../#">
                                        <span class="cate-img">
                                          <em>Kỹ sư cầu nối</em>
                                        </span>
                                        <span class="cate-count">(110)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../#">
                                        <span class="cate-img">
                                          <em>Designer</em>
                                        </span>
                                        <span class="cate-count">(2300)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../#">
                                        <span class="cate-img">
                                          <em>Product Manager</em>
                                        </span>
                                        <span class="cate-count">(99)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../#" class="readallstyle reads1">Xem tất cả</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="job-sidebar">
                        <div class="sb-banner">
                            <img src="{{ asset('img/ads1.jpg') }}" class="advertisement"  alt=""/>
                        </div>
                    </div>
                </div>
                <!-- (end) sidebar -->
            </div>
        </div>
    </div>
    <!-- (end) job board & sidebar section  -->

    <div class="clearfix"></div>


    <!-- job board v2 -->
    <div class="container-fluid">
        <div class="container job-board2">
            <div class="row">
                <div class="col-md-12 job-board2-wrap-header">
                    <h3>Tin tuyển dụng, việc làm mới nhất</h3>
                </div>
                <div class="col-md-12 job-board2-wrap">
                    <div class="owl-carousel owl-theme job-board2-contain">
                        @foreach($jobComposer as $key => $job)
                            <div class="item job-latest-item">
                                <a href="{{ route('view.job', ['job' => $job->id]) }}" class="job-latest-group">
                                    <div class="job-lt-logo">
                                        <img src="{{ $job->company->avatar ? asset($job->company->avatar) : asset('img/icon_avatar.jpg') }}">
                                    </div>
                                    <div class="job-lt-info">
                                        <h3>{{ $job->title }}</h3>
                                        <a class="company"
                                           href="{{ route('view.job', ['job' => $job->id]) }}">{{ $job->company->name }}</a>
                                        <p class="address"><i class="fa fa-map-marker pr-1"
                                                              aria-hidden="true"></i> {{ $job->city->name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: true,
                        slideBy: 2,
                        dots: false
                    },
                    600: {
                        items: 4,
                        nav: false,
                        slideBy: 2,
                        dots: false
                    },
                    1000: {
                        items: 6,
                        nav: true,
                        loop: false,
                        slideBy: 2
                    }
                }
            });
        })
    </script>
    <!-- (end) job board v2 -->

    <div class="clearfix"></div>

    <!-- top employer -->
    <div class="container-fluid">
        <div class="container top-employer">
            <div class="row">
                <div class="col-md-12 top-employer-contain">
                    <div class="header">
                        <h3>Nhà tuyển dùng hàng đầu</h3>
                    </div>
                    <div class="row">
                        @foreach($companyComposer as $company)
                            <div class="col-md-3 col-sm-6 col-12 top-employer-wrap">
                                <div class="top-employer-item">
                                    <a href="{{ $company->url }}">
                                        <div class="emp-img-thumb">
                                            <img src="{{ $company->avatar ? asset($company->avatar) : asset('img/icon_avatar.jpg') }}">
                                        </div>
                                        <h3 class="company">{{ $company->name }}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (end) top employer -->

    <div class="clearfix"></div>


    <!-- job-best-salary -->
    <div class="container-fluid">
        <div class="container job-best-salary">
            <div class="row">
                <div class="col-md-12 job-board2-wrap-header job-best-salary-header">
                    <h3><i class="fa fa-briefcase pr-2"></i> Việc làm hấp dẫn</h3>
                </div>
            </div>
            <div class="row job-best-salary-inner">
                @foreach($attractiveJobComposer as $attJob)
                    <div class="col-md-6 job-over-item">
                        <div class="job-inner-over-item">
                            <a href="{{ route('view.job', ['job' => $attJob->id]) }}">
                                <div class="thumbnail">
                                    <img src="{{ $attJob->company->avatar ? asset($attJob->company->avatar) : asset('img/icon_avatar.jpg') }}" alt="company logo image">
                                </div>
                                <div class="content">
                                    <div class="job-name">
                                        {{ $attJob->title }}
                                    </div>
                                    <a href="{{ route('view.job', ['job' => $attJob->id]) }}" class="company">
                                        {{ $attJob->company->name }}
                                    </a>
                                </div>
                                <div class="extra-info">
                                    <p class="salary mt-2"><i
                                            class="fa fa-money pr-2"></i>${{App\Helpers\Common::number_shorten($attJob->salary_start)}}
                                        - ${{ App\Helpers\Common::number_shorten($attJob->salary_end) }}
                                    </p>
                                    <p class="place"><i class="fa fa-map-marker pr-2"></i>{{ $attJob->city->name }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- (end) job-best-salary -->


    <!-- job-best-salary -->
    <div class="container-fluid">
        <div class="container job-best-salary">
            <div class="row">
                <div class="col-md-12 job-board2-wrap-header job-best-salary-header">
                    <h3><i class="fa fa-briefcase pr-2"></i> Việc làm lương cao</h3>
                </div>
            </div>
            <div class="row job-best-salary-inner">
                @foreach($highPayJobComposer as $highJob)
                    <div class="col-md-6 job-over-item">
                        <div class="job-inner-over-item">
                            <a href="{{ route('view.job', ['job' => $highJob->id]) }}">
                                <div class="thumbnail">
                                    <img src="{{ $highJob->company->avatar ? asset($highJob->company->avatar) : asset('img/icon_avatar.jpg') }}" alt="company logo image">
                                </div>
                                <div class="content">
                                    <div class="job-name">
                                        {{ $highJob->title }}
                                    </div>
                                    <a href="{{ route('view.job', ['job' => $highJob->id]) }}" class="company">
                                        {{ $highJob->company->name }}
                                    </a>
                                </div>
                                <div class="extra-info">
                                    <p class="salary mt-2"><i
                                            class="fa fa-money pr-2"></i>${{App\Helpers\Common::number_shorten($highJob->salary_start)}}
                                        - ${{ App\Helpers\Common::number_shorten($highJob->salary_end) }}
                                    </p>
                                    <p class="place"><i class="fa fa-map-marker pr-2"></i>{{ $highJob->city->name }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- (end) job-best-salary -->

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="home-ads">
                        <a href="../#">
                            <img src="{{ asset('img/hna2.jpg') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <!-- news -->
    <div class="container-fluid">
        <div class="container news-wrapper">
            <div class="row">
                <div class="col-md-12 news-wrapper-head">
                    Tư vấn nghề nghiệp từ HR Insider
                </div>
                @foreach($postComposer as $post)
                    <div class="col-md-4 col-sm-12 col-12 news-item">
                        <div class="news-item-inner">
                            <a href="../#wrap">
                                <div class="news-thumb" style="background-image: url({{ $post->thumb ? asset($post->thumb) : asset('posts/news1.jpg') }});"></div>
                            </a>
                            <div class="news-details">
                                <div class="tags">
                                    <a href="../#tag1">{{ $post->category }}</a>
                                </div>
                                <div class="title">
                                    <a href="../#">
                                        {{ $post->title }}
                                    </a>
                                </div>
                                <div class="meta">
                                    {{ $post->description }}
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- (end) news -->
@endsection
