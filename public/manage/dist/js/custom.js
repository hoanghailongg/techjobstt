// Setup AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Customize toastr
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


// Create slug category

var slug = function(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
    var to   = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[áàảạãăắằẳẵặâấầẩẫậ]/gi, 'a');
    str = str.replace(/[éèẻẽẹêếềểễệ]/gi, 'e');
    str = str.replace(/[iíìỉĩị]/gi, 'i');
    str = str.replace(/[óòỏõọôốồổỗộơớờởỡợ]/gi, 'o');
    str = str.replace(/[úùủũụưứừửữự]/gi, 'u');
    str = str.replace(/[ýỳỷỹỵ]/gi, 'y');
    str = str.replace(/đ/gi, 'd');

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
};


// Login
$(document).ready(function () {
    $("#login").click(function () {
        const btnLogin = $("#login");
        const btnLoginText = btnLogin.text();
        let url_redirect = $("#url_previous").val();
        btnLogin.attr("disabled", true);
        btnLogin.empty();
        btnLogin.append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        $.ajax({
            type: 'POST',
            url: '/admin/auth/login',
            data: $("#form_login").serialize(),
            dataType: 'json',
            success: function (data) {
                toastr.success(data.message);
                setTimeout(function () {
                    window.location.href = url_redirect;
                }, 500);

            },
            error: function (xhr) {
                btnLogin.removeAttr("disabled");
                btnLogin.empty();
                btnLogin.append(btnLoginText);
                var err = JSON.parse(xhr.responseText);
                if (xhr.status === 401) {
                    toastr.error(err.message)
                }

                if (xhr.status === 422) {
                    if (err.errors.email) {
                        toastr.error(err.errors.email)
                    }
                    if (err.errors.password) {
                        toastr.error(err.errors.password)
                    }
                }
            }
        })
    })
})
// END login


$('.btn-show').on( "click touchend",function(){
    var url = $(this).attr('data-url');
    if ($('#show').length){
        $("#show").remove();
    }
    $.ajax({
        type: 'get',
        url: url,
        success: function(response) {
            $( "body" ).append(response);
            $('#show').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(errorThrown)
        }
    })
})
// Remove
function removeFunction(slug){
    const url = $(".btn-delete").attr('data-url');
    Swal.fire({
        title: 'Bạn đã chắc chắn xóa?',
        text: "Sau khi xóa, dữ liệu sẽ không thể không phục.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý, tiến hành xóa!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'delete',
                dataType: 'json',
                data: { slug },
                url: url,
                success: function (data){
                    if (data.error === false){
                        Swal.fire(
                            'Thành công!',
                            data.message,
                            'success'
                        )
                        setTimeout(function (){
                            location.reload();
                        }, 500);
                    }else {
                        let message = 'Xóa không thành công, vui lòng thử lại.'
                        if (typeof data.message !== 'undefined' || data.message !== null) {
                            message =  data.message
                        }

                        Swal.fire(
                            'Lỗi!',
                            message,
                            'error'
                        )
                    }

                }
            })
        }
    })
}


function changeStatusComment(id) {
    const url = 'users/update';
    const status = $(".btn-change").attr('data-status');
    Swal.fire({
        title: 'Bạn đã chắc chắn thay đổi trạng thái người dùng?',
        text: "Sau khi thay đổi, trạng thái của người dùng sẽ được cập nhật.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý, tiến hành cập nhật!'
    }).then((confirm) => {
        if (confirm.isConfirmed) {
            $.ajax({
                method: 'PATCH',
                data: {
                    user:id,
                    status:status
                },
                url: url,
                success: function (data){
                    if (data.error === false){
                        Swal.fire(
                            'Updated!',
                            data.message,
                            'success'
                        );
                        setTimeout(function (){
                            location.reload();
                        }, 500);
                    }else {
                        Swal.fire(
                            'Update Error!',
                            'Cập nhật không thành công, vui lòng thử lại.',
                            'error'
                        );
                    }

                }
            });
        }
    });
}

$(document).on('hidden.bs.modal', '.modal', function () {
    $(".modal").remove();
});

function removeModal(idModal) {
    $(`#${idModal}`).remove();
    $(".modal-backdrop").remove();
}

function reloadTableData(){
    $(".card-body").load(window.location.href + " #table-no-sort", function () {
        $("#table-no-sort").DataTable();
    });
}


function updateStatus(url) {
    if ($('#status').length){
        $("#status").remove();
    }
    $.ajax({
        type: 'get',
        url: url,
        success: function(response) {
            $( "body" ).append(response);
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
