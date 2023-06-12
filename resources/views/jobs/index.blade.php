@extends('layouts.app')

@section('content')
    @include('layouts.search-section')
    <div class="container-fluid">
        <div class="container search-wrapper">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <h4 class="search-find">Tìm thấy {{ !$jobs->isEmpty() ? $jobs->count() : 0 }} việc làm đang tuyển dụng</h4>
                    <div class="job-board-wrap">
                        <div class="job-group">
                            @foreach($jobs as $key => $job)
                                <div class="job pagi">
                                    <div class="job-content">
                                        <div class="job-logo">
                                            <a href="{{ route('view.job', ['job' => $job->id]) }}">
                                                <img src="{{ asset($job->company->avatar) }}" class="job-logo-ima"
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
                                                        $nameLang = '';
                                                        if (request()->input('language')) {
                                                            $nameLang = $languagesComposer[request()->input('language')];
                                                        } else if (!empty($languages)) {
                                                            $nameLang = trim(explode(',', $languages)[0]);
                                                        }
                                                    @endphp
                                                    <i class="fa fa-code" aria-hidden="true"></i> <a
                                                        href="{{ route('view.job', ['job' => $job->id]) }}"> {{ $nameLang  }}</a>
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
