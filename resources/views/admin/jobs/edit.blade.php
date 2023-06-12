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
                                <a href="{{route('admin.jobs.index')}}"
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
                        <form action="{{ route('admin.jobs.update',$job->id) }}" method="post"
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
                                                <label for="title"
                                                       class="col-sm-2 col-form-label">{{__('Tiêu đề')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-pencil-alt"></i></span>
                                                        </div>
                                                        <input type="text" id="title"
                                                               name="title"
                                                               value="{{old('title') ?? $job->title}}"
                                                               class="form-control"
                                                               placeholder="Fullstack .NET Developer (Angular/React)"
                                                               required/>
                                                    </div>
                                                    <span class="form-text">
                                                        <i class="fa fa-info-circle"></i> Tối đa 100 kí tự
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="level"
                                                       class="col-sm-2 col-form-label">{{__('Cấp bậc')}}</label>
                                                <div class="col-sm-10">
                                                    <input id="level" type="text" class="form-control"
                                                           placeholder="Nhân viên"
                                                           name="level" value="{{old('level') ?? $job->level}}">
                                                    <span class="form-text">
                                                        <i class="fa fa-info-circle"></i> Tối đa 100 kí tự
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="level"
                                                       class="col-sm-2 col-form-label">{{__('Lương')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <input id="salary_start" type="number" min="0"
                                                                   class="form-control"
                                                                   name="salary_start" placeholder="1000"
                                                                   value="{{old('salary_start') ?? $job->salary_start}}">
                                                        </div>
                                                        <span
                                                            class="col-sm-2 d-flex justify-content-center align-items-center">đến</span>
                                                        <div class="col-sm-5">
                                                            <input id="salary_end" type="number" min="0"
                                                                   class="form-control"
                                                                   name="salary_end" placeholder="5000"
                                                                   value="{{old('salary_end') ?? $job->salary_end}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="content"
                                                       class="col-sm-2 col-form-label">{{__('Ngôn ngữ lập trình')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <select class="select2" multiple="multiple" name="languages[]"
                                                            data-placeholder="Lựa chọn ngôn ngữ lập trình"
                                                            style="width: 100%;">
                                                        @foreach($languages as $lang)
                                                            <option
                                                                value="{{ $lang->id }}" {{ in_array($lang->id, $job->getLanguageAttribute($job->languages)) ? 'selected' : '' }}>{{ $lang->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="content"
                                                       class="col-sm-2 col-form-label">{{__('Địa điểm làm việc')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <select class="select2" name="city"
                                                            data-placeholder="Lựa chọn địa điểm" style="width: 100%;">
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{ $city->id }}" {{ $city->id === $job->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="content"
                                                       class="col-sm-2 col-form-label">{{__('Công ty')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <select class="select2" name="company"
                                                            data-placeholder="Lựa chọn công ty" style="width: 100%;">
                                                        @foreach($companies as $company)
                                                            <option
                                                                value="{{ $company->id }}" {{ $company->id === $job->company_id ? 'selected' : '' }}>{{ $company->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="content"
                                                       class="col-sm-2 col-form-label">{{__('Nội dung')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea id="content" class="summernote"
                                                              name="content">{{old('content') ?? $job->content}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="gender"
                                                       class="col-sm-2 col-form-label">{{__('Giới tính')}}</span></label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-pencil-alt"></i></span>
                                                        </div>
                                                        <input type="text" id="gender"
                                                               name="gender"
                                                               value="{{old('gender') ?? $job->gender}}"
                                                               class="form-control"
                                                               placeholder="Nam"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="experience"
                                                       class="col-sm-2 col-form-label">{{__('Kinh nghiệm')}}</span></label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-pencil-alt"></i></span>
                                                        </div>
                                                        <input type="text" id="experience"
                                                               name="experience"
                                                               value="{{old('experience') ?? $job->experience}}"
                                                               class="form-control"
                                                               placeholder="1 năm"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="experience"
                                                       class="col-sm-2 col-form-label">{{__('Hạn nộp')}}<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <div class="input-group date" id="reservationdate"
                                                             data-target-input="nearest">
                                                            <input type="text" name="date_end"
                                                                   value="{{ date('m/d/Y', strtotime($job->date_end)) }}"
                                                                   class="form-control datetimepicker-input"
                                                                   data-target="#reservationdate"/>
                                                            <div class="input-group-append"
                                                                 data-target="#reservationdate"
                                                                 data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
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
    <link rel="stylesheet" href="{{ asset('manage/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
    <script>
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
    </script>
@endpush
