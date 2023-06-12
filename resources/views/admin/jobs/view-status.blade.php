<div class="modal fade" id="status">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật trạng thái công việc <b>{{$job->title}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                <div class="col-md-12">
                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <div class="table">
                                <form id="update-status" action="{{route('admin.jobs.update-status')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="status"
                                               class="col-sm-2 col-form-label">{{__('Trạng thái')}}<span class="text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="hidden" name="task_id" value="{{$job->id}}">
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="0" {{$job->is_active == 0 ? 'selected' : ''}}>Đang chờ duyệt</option>
                                                    <option value="1" {{$job->is_active == 1 ? 'selected' : ''}}>Đã duyệt</option>
                                                    <option value="2" {{$job->is_active == 2 ? 'selected' : ''}}>Từ chối</option>
                                                </select>
                                            </div>
                                            <span class="form-text"><i class="fa fa-info-circle"></i> Trạng thái công việc</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button id="update-status__action" type="submit" class="btn btn-success float-right btn-block">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Đóng')}}</button>
            </div>
        </div>
    </div>
</div>
