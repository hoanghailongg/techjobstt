function getFormModalAddData(idModal, urlCallModal) {
    $.ajax({
        type: 'get',
        url: urlCallModal,
        success: function (response) {
            $("body").append(response);
            $(`#${idModal}`).modal('show');
        }
    }).done(function () {
        $("#actionFormSubmitData").on('click', function (e) {

            e.preventDefault();

            const form = $('#formSubmitData');
            const actionUrl = form.attr('action');
            var formData = new FormData($('#formSubmitData')[0]);
            $.ajax({
                url: actionUrl,
                type: "post",
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    toastr.success(response.data.message);
                    $(`#${idModal}`).modal('hide');
                    // load page is url current, dom class .table new and insert to .table selected
                    reloadTableData();
                }
            });
        });
    });
}

function getFormModalEdit(idModal, urlCallModal) {
    $.ajax({
        type: 'get',
        url: urlCallModal,
        success: function (response) {
            $("body").append(response);
            $(`#${idModal}`).modal('show');
        }
    }).done(function () {
        $("#actionFormEditData").on('click', function (e) {

            e.preventDefault();

            const form = $('#formEditData');
            const actionUrl = form.attr('action');
            const formData = new FormData($('#formEditData')[0]);
            $.ajax({
                url: actionUrl,
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    toastr.success(response.data.message);
                    $(`#${idModal}`).modal('hide');
                    // load page is url current, dom class .table new and insert to .table selected
                    reloadTableData();
                }
            });
        });
    });
}

// Modal view detail.
$(document).on('click touchend', '.btn-show', function () {
    const url = $(this).attr('data-url');
    removeModal("show");
    $.ajax({
        type: 'post',
        url: url,
        success: function (response) {
            $("body").append(response);
            $("#show").modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(errorThrown)
        }
    })
})

// Remove AJAX.
$(document).on('click touchend', '.btn-delete', function () {
    const url = $(this).attr('data-url');
    Swal.fire({
        title: 'Bạn có chắc chắn xóa?',
        text: 'Sau khi xóa, dữ liệu không thể phục hồi.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý, tiến hành xóa!',
        cancelButtonText: 'Hủy',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'delete',
                dataType: 'json',
                url: url,
                success: function (response) {
                    Swal.fire(
                        'Thành công!',
                        response.data.message,
                        'success'
                    )
                    // load page is url current, dom class .table new and insert to .table selected
                    reloadTableData();
                }
            })
        }
    })
});
