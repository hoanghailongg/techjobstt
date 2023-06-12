@extends('admin.layouts.app')

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
                            <li class="breadcrumb-item"><a href="{{config('app.url_admin')}}">{{__('Trang chủ')}}</a>
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
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{$title}} {!! __('<span class="text-muted">(Vui lòng điền các trường có chứa dấu <span class="text-danger">*</span>)</span>') !!}</h3>
                        <div class="card-tools">
                            <div class="btn-group mr-5">
                                <a href="{{route('admin.employers.index')}}"
                                   class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span
                                        class="hidden-xs"> Trở lại danh sách</span></a>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('admin.employers.update',$company->id) }}" method="post"
                              enctype="multipart/form-data">
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{__('Tổng quan')}}</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                        title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{__('Email')}}</label>
                                                <div class="col-sm-10">
                                                    <input type="text"
                                                           value="{{$company->email}}"
                                                           class="form-control"
                                                           readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="full_name"
                                                       class="col-sm-2 col-form-label">{{__('Tên người phụ trách')}}
                                                    <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input id="full_name" type="text" class="form-control"
                                                           placeholder="Người Tuyển Dụng"
                                                           name="full_name"
                                                           value="{{old('full_name') ?? $company->full_name}}"
                                                           required
                                                    />
                                                    <span class="form-text">
                                                        <i class="fa fa-info-circle"></i> Tối đa 100 kí tự
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="name"
                                                       class="col-sm-2 col-form-label">{{__('Tên công ty')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input id="name" type="text" class="form-control"
                                                           placeholder="FPT Software"
                                                           name="name" value="{{old('name') ?? $company->name}}" required />
                                                    <span class="form-text">
                                                        <i class="fa fa-info-circle"></i> Tối đa 100 kí tự
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone"
                                                       class="col-sm-2 col-form-label">{{__('Số điện thoại liên hệ')}}
                                                    <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input id="phone" type="text"
                                                           class="form-control"
                                                           name="phone"
                                                           value="{{old('phone') ?? $company->phone}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="address"
                                                       class="col-sm-2 col-form-label">{{__('Địa chỉ')}}</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="address"
                                                           name="address"
                                                           value="{{old('address') ?? $company->address}}"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="is_active"
                                                       class="col-sm-2 col-form-label">{{__('Trạng thái')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <select id="is_active" class="select2" name="is_active"
                                                            data-placeholder="Lựa chọn trạng thái" style="width: 100%;">
                                                        <option value="0" {{ $company->is_active == 0 ? 'selected' : '' }}>Chờ duyệt</option>
                                                        <option value="1" {{ $company->is_active == 1 ? 'selected' : '' }}>Hoạt động</option>
                                                        <option value="2" {{ $company->is_active == 2 ? 'selected' : '' }}>Hủy</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-success d-block w-100">{{__('Chỉnh sửa')}}</button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('stylesheets')
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('manage/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('manage/plugins/select2/css/select2.min.css')}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('manage/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('manage/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@push('scripts')
    <!-- Summernote -->
    <script src="{{asset('manage/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- File input -->
    <script src="{{asset('manage/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- Select2 -->
    <script rel="stylesheet" src="{{asset('manage/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Repeater button -->
    <script rel="stylesheet" src="{{asset('manage/plugins/jquery.repeater/jquery.repeater.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('manage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('manage/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('manage/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Edit page -->
    <script src="{{asset('manage/dist/js/pages/edit-form.js')}}"></script>
@endpush
