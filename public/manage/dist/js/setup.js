// Setup AJAX.
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        $("#loading").css({"display": "grid", "alignContent": "center"});
    },

    complete: function () {
        $('#loading').hide();
        $('.summernote').summernote({
            dialogsInBody: true,
            height: 300
        });

        $("#name").on('keyup change focusout', function () {
            const name = $('#name').val();
            $('#slug').val(slug(name));
        })
        bsCustomFileInput.init();
    }
    , error: function (jqXHR, textStatus, errorThrown) {

        //toastr.error("Lỗi: " + textStatus + ": " + errorThrown);

        if (jqXHR.responseText) {
            let list_error = JSON.parse(jqXHR.responseText);
            $.each(list_error.errors, function (index, value) {
                toastr.error(value);
            });
        }

        if (jqXHR.status === 419) {
            toastr.error('Token đã hết hạn. Vui lòng chờ tải lại trang để lấy token mới.');
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        } else {

        }
    }
});

// Customize toastr.
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

// Create slug.
var slug = function (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
    var to = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
    for (var i = 0, l = from.length; i < l; i++) {
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

// Clear modal when close.
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