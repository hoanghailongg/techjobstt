@extends('layouts.app')

@section('content')
    <!-- job detail header -->
    <div class="container-fluid job-detail-wrap">
        <div class="container job-detail">
            <div class="job-detail-header">
                <div class="row">
                    <div class="col-md-2 col-sm-12 col-12">
                        <div class="job-detail-header-logo">
                            <a href="{{ route('view.job', ['job' => $job->id]) }}">
                                <!-- (end) main nav -->
                                <!-- (end) main nav -->
                                <img src="{{ asset($job->company->avatar) }}" class="job-logo-ima" alt="job-logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-12" style="padding: 15px 0;">
                        <div class="job-detail-header-desc">
                            <div class="job-detail-header-title">
                                <!-- (end) main nav -->
                                <!-- (end) main nav -->
                                <a href="{{ route('view.job', ['job' => $job->id]) }}">{{ $job->title }}</a>
                            </div>
                            <div class="job-detail-header-company">
                                <!-- (end) main nav -->
                                <!-- (end) main nav -->
                                <a href="{{ route('view.job', ['job' => $job->id]) }}">{{ $job->company->name }}</a>
                            </div>
                            <div class="job-detail-header-de">
                                <ul>
                                    <li><i class="fa fa-map-marker icn-jd"></i><span>{{ $job->city->name }}</span></li>
                                    <li><i class="fa fa-usd icn-jd"></i><span>{{ $job->salary_start }}$ - {{ $job->salary_end }}$</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-calendar icn-jd"></i><span>{{ date('d/m/Y', strtotime($job->date_end)) }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="job-detail-header-tag">
                                <ul>
                                    @php
                                        $languages = $job->language_names;
                                        $arrLanguage = explode(',', $languages);
                                    @endphp
                                    @foreach($arrLanguage as $lang)
                                        <li>
                                            <a href="#">{{$lang}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-12">
                        <div class="jd-header-wrap-right">
                            <div class="jd-center">
                                <form action="{{ route('jobs.submit') }}" method="post">
                                    @csrf
                                    @if(empty($follow) )
                                        <input type="hidden" name="task_id" value="{{ $job->id }}">
                                        <input class="btn btn-primary btn-apply" type="submit" value="Nộp Đơn"/>
                                    @else
                                        @php
                                            $class = 'btn-primary';

                                            if ($follow->status == 0) {
                                                $class = 'btn-warning text-white';
                                            }

                                            if ($follow->status == 1) {
                                                $class = 'btn-success';
                                            }

                                            if ($follow->status == 2) {
                                                $class = 'btn-danger';
                                            }
                                        @endphp
                                        <input class="btn {{ $class }} btn-apply" type="submit" disabled
                                               value="{{ \App\Helpers\Common::getStatusFollow($follow->status) }}"/>
                                    @endif
                                </form>
                                <p class="jd-view">Lượt xem: <span>{{ number_format($job->count) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (end) job detail header -->

    <div class="clearfix"></div>

    <!-- Phần thân -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <!-- Main wrapper -->
                <div class="col-md-8 col-sm-12 col-12 clear-left">
                    <div class="main-wrapper">
                        <h2 class="widget-title">
                            <span>Mô tả công việc</span>
                        </h2>
                        <div class="jd-content">
                            {{ $job->content }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4 col-sm-12 col-12 clear-right">
                    <div class="side-bar mb-3">
                        <h2 class="widget-title">
                            <span>Thông tin</span>
                        </h2>

                        <div class="job-info-wrap">
                            <div class="job-info-list">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="ji-title">Nơi làm việc:</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="ji-main">{{ $job->city->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="job-info-list">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="ji-title">Cấp bậc:</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="ji-main">{{ $job->level }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="job-info-list">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="ji-title">Lương:</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="ji-main">{{ $job->salary_start }}$ - {{ $job->salary_end }}$</span>
                                    </div>
                                </div>
                            </div>

                            <div class="job-info-list">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="ji-title">Hạn nộp:</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="ji-main">{{ date('d/m/Y', strtotime($job->date_end)) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="job-info-list">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="ji-title">Giới tính:</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="ji-main">{{ $job->gender }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="job-info-list">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span class="ji-title">Kinh nghiệm:</span>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="ji-main">{{ $job->experience }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="side-bar mb-3">
                        <h2 class="widget-title">
                            <span>Giới thiệu công ty</span>
                        </h2>
                        <div class="company-intro">
                            <a href="{{ $job->company->url }}">
                                <img src="{{ $job->company->avatar ? asset($job->company->avatar) : asset('img/icon_avatar.jpg') }}" class="job-logo-ima" alt="job-logo">
                            </a>
                        </div>
                        <h2 class="company-intro-name">{{ $job->company->name }}</h2>
                        <ul class="job-add">
                            <li>
                                <i class="fa fa-map-marker ja-icn"></i>
                                <span>Trụ sở: {{ $job->company->address }}</span>
                            </li>
                            <li>
                                <i class="fa fa-bar-chart ja-icn"></i>
                                <span>Quy mô công ty: {{ $job->company->size }}</span>
                            </li>
                        </ul>

                        <div class="wrap-comp-info mb-2">
                            <a href="{{ $job->company->url }}" class="btn btn-primary btn-company">Xem thêm</a>
                        </div>
                    </div>

                    <div class="side-bar mb-3">
                        <h2 class="widget-title">
                            <span>Việc làm tương tự</span>
                        </h2>
                        <div class="job-tt-contain">
                            @foreach($sameJob as $sjob)
                                <div class="job-tt-item">

                                    <a href="{{ route('view.job', ['job' => $sjob->id]) }}" class="thumb">
                                        <div style="background-image: url({{ asset($sjob->company->avatar) }})"></div>
                                    </a>

                                    <div class="info">
                                        <a href="{{ route('view.job', ['job' => $sjob->id]) }}" class="jobname">
                                            {{ $sjob->title }}
                                        </a>
                                        <a href="{{ route('view.job', ['job' => $sjob->id]) }}" class="company">
                                            {{ $sjob->company->name }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="side-bar mb-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="home-ads">
                                        <a href="#">
                                            <img src="{{ asset('img/ads1.jpg') }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (end) Phần thân -->
@endsection
