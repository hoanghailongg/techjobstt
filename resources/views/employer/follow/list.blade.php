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
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{$title}}.</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered dt-responsive"
                                       style="table-layout: fixed;width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người dùng</th>
                                        <th>Email</th>
                                        <th>Công việc</th>
                                        <th>Ngày nộp đơn</th>
                                        <th>Trạng thái</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i= 0; @endphp
                                    @foreach($follows as $key => $follow)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{$follow->user->username}}</td>
                                            <td>{{$follow->user->email}}</td>
                                            <td>{{$follow->job->title}}</td>
                                            <td>{{date('H:i d/m/Y', strtotime($follow->created_at))}}</td>
                                            <td>{!! \App\Helpers\Common::showStatus($follow->status) !!}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('employer.follow.detail', $follow->id) }}"><i class="far fa-eye"></i></a>
                                                <button class="btn btn-info btn-sm btn-update"
                                                        onclick="updateStatus('{{route('employer.follow.show-status', $follow->id)}}')"
                                                        data-toggle="modal" data-target="#status">
                                                    <i class="fas fa-wrench"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Người dùng</th>
                                        <th>Email</th>
                                        <th>Công việc</th>
                                        <th>Ngày nộp đơn</th>
                                        <th>Trạng thái</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('stylesheets')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('manage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('manage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('manage/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('manage/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('manage/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('manage/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('manage/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('manage/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset('manage/dist/js/pages/datatable.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('manage/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        function updateStatus(url) {
            if ($('#status').length) {
                $("#status").remove();
            }
            $.ajax({
                type: 'get',
                url: url,
                success: function (response) {
                    $("body").append(response);
                    $('#status').modal('show');
                    update();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error(errorThrown)
                }
            })
        }

        function update() {
            let frm = $('#update-status');
            let btn = $('#update-status__action');
            btn.on("click", function (e) {
                btn.val("Đang cập nhật...");
                e.preventDefault();
                $.ajax({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    data: frm.serialize(),
                    success: function (response) {
                        btn.removeAttr("disabled");
                        btn.val("Cập nhật");
                        if (response.error === false) {
                            toastr.success(response.message);
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                        btn.removeAttr("disabled");
                        btn.val("Cập nhật");
                        if (xhr.responseText) {
                            let list_error = JSON.parse(xhr.responseText);
                            $.each(list_error.errors, function (index, value) {
                                toastr.error(value);
                            });
                            if (xhr.status === 419) {
                                toastr.error('Token đã hết hạn. Vui lòng chờ tải lại trang để lấy token mới.');
                                setTimeout(function () {
                                    window.location.reload();
                                }, 1000);
                            }
                        }
                    }
                });

            });
        }
    </script>
@endpush
