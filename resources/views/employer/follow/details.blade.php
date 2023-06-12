@extends('employer.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{config('app.url_employer')}}">{{__('Trang chủ')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    {{$title}}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $follow->user->full_name }}</b></h2>
                                            <p class="text-muted text-sm"><b>Công việc: {{ $follow->job->title }}</b> </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fas fa-lg fa-building"></i></span> Địa chỉ: {{ $follow->user->address }}
                                                </li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                                    Số điện thoại #: {{ $follow->user->phone }}
                                                </li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span>
                                                    Thời gian nộp: {{ date('d/m/y H:i', strtotime($follow->created_at)) }}
                                                </li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-bell fa-lg"></i></span>
                                                    Trạng thái: {{ \App\Helpers\Common::getStatusFollow($follow->status) }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="{{ $follow->user->avatar ? asset($follow->user->avatar) : asset('img/icon_avatar.jpg') }}" width="160" height="160"
                                                 style="object-fit: cover;border-radius: 10%;" alt="user-avatar"
                                                 class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
