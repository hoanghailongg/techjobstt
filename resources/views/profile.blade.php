@extends('layouts.app')

@section('content')
    <!-- widget recuitment  -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="home-ads">
                        <a href="#">
                            <img src="{{ asset('img/hna2.jpg') }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (end) widget recuitment  -->
    <!-- published recuitment -->
    <div class="container-fluid published-recuitment-wrapper">
        <div class="container published-recuitment-content">
            <div class="row">
                <div class="col-md-8 col-sm-12 col-12 recuitment-inner">
                    <form class="employee-form" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="accordion" id="accordionExample">
                            <div class="card recuitment-card">
                                <div class="card-header recuitment-card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <a class="btn btn-link btn-block text-left recuitment-header" type="button"
                                           data-toggle="collapse"
                                           data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Thông tin tài khoản
                                            <span id="clickc1_advance2" class="clicksd">
                                                <i class="fa fa fa-angle-up"></i>
                                            </span>
                                        </a>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                     data-parent="#accordionExample">
                                    <div class="card-body recuitment-body row">
                                        <div class="col-md-3">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                         style="background-image: url({{ asset($profile->avatar) ?? "https://i.pravatar.cc/500?img=7" }});">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label text-right label">Tên người
                                                    dùng<span
                                                        style="color: red"
                                                        class="pl-2">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="username"
                                                           placeholder="username"
                                                           value="{{ old('username') ?? $profile->username }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label text-right label">Họ tên<span
                                                        style="color: red"
                                                        class="pl-2">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="full_name"
                                                           placeholder="Nhập họ và tên"
                                                           value="{{ old('full_name') ?? $profile->full_name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label text-right label">Số điện
                                                    thoại</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" name="phone" placeholder="0123456789"
                                                           value="{{ old('phone') ?? $profile->phone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label text-right label">Giới tính<span
                                                        style="color: red"
                                                        class="pl-2">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="jobGender" name="gender">
                                                        <option value="">Chọn giới tính</option>
                                                        <option value="1" {{ $profile->gender == 1 ? 'selected' : '' }}>Nam</option>
                                                        <option value="2" {{ $profile->gender == 2 ? 'selected' : '' }}>Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label text-right label">Tỉnh/ Thành
                                                    phố<span style="color: red"
                                                             class="pl-2">*</span></label>
                                                <div class="col-sm-9">
                                                    <select type="text" class="form-control" id="jobProvince2"
                                                            name="city">
                                                        @foreach($cities as $city)
                                                            <option
                                                                value="{{ $city->id }}" {{ $city->id === $profile->city ? 'selected' : '' }}>{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label text-right label">Chỗ ở hiện
                                                    tại<span style="color: red"
                                                             class="pl-2">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="address"
                                                           placeholder="Nhập địa chỉ"
                                                           value="{{ old('address') ?? $profile->address }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="rec-submit">
                            <button type="submit" class="btn-submit-recuitment mb-3 ml-3" name="">
                                <i class="fa fa-floppy-o pr-2"></i>Lưu Hồ Sơ
                            </button>
                        </div>
                    </form>

                </div>
                <!-- Side bar -->
                <div class="col-md-4 col-sm-12 col-12">
                    <div class="recuiter-info">
                        <div class="recuiter-info-avt">
                            <img src="{{ asset($profile->avatar) }}">
                        </div>
                        <div class="clearfix list-rec">
                            <h4>{{ $profile->full_name }}</h4>
                            <ul>
                                <li><a href="#">Việc làm đã nộp <strong>({{ number_format($jobSubmitted) }})</strong></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- (end) published recuitment -->
    <div class="clearfix"></div>
@endsection

@push('scripts')
    <script type="text/javascript">
        // Avatar upload and preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });
    </script>
@endpush
