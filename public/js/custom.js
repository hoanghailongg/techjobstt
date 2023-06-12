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
            url: $("#form_login").attr('action'),
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
                let err = JSON.parse(xhr.responseText);
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
