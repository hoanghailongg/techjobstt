@extends('employer.layouts.app')

@section('content')
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img
                                        class="profile-user-img img-fluid img-circle"
                                        alt="User profile picture"
                                        src="{{ $company->avatar ? asset($company->avatar) :  asset('manage/img/user2-160x160.jpg') }}"
                                    />
                                </div>

                                <h3 class="profile-username text-center">{{ $company->full_name }}</h3>

                                <p class="text-muted text-center">{{ $company->name }}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Công việc đã tạo</b> <a
                                            class="float-right">{{ number_format($countJobOfCompany) }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Đơn xin việc</b> <a
                                            class="float-right">{{ number_format($countFollowOfCompany) }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal" method="post" enctype="multipart/form-data"
                                      action="{{ route('employer.profile.update', Auth::guard('employer')->id()) }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Tên người liên hệ</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName"
                                                   name="full_name"
                                                   value="{{ old('full_name') ?? $company->full_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPhone" class="col-sm-2 col-form-label">Số điện thoại liên
                                            hệ</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPhone"
                                                   name="phone" value="{{ old('phone') ?? $company->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Tên công ty</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2"
                                                   name="name" value="{{ old('name') ?? $company->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-2 col-form-label">Địa chỉ công
                                            ty</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputAddress"
                                                   name="address" value="{{ old('address') ?? $company->address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputUrl" class="col-sm-2 col-form-label">Website công ty</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputUrl"
                                                   name="url" value="{{ old('url') ?? $company->url }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="customFile" class="col-sm-2 col-form-label">Ảnh đại diện</label>
                                        <div class="col-sm-10">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                       name="avatar">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="checkbox">
                                                <label class="font-weight-normal font-italic text-warning">Không nhập thông tin phía dưới nếu bạn không muốn thay đổi mật khẩu.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputPassword"
                                                   name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputRePassword" class="col-sm-2 col-form-label">Nhập lại mật khẩu
                                            mới</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputRePassword"
                                                   name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputCurrentPassword" class="col-sm-2 col-form-label">Mật khẩu hiện
                                            tại</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputCurrentPassword"
                                                   name="old_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('stylesheets')
@endpush

@push('scripts')
    <script src="{{asset('manage/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endpush
