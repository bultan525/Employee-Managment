$(function () {
    "use strict";
    var xTokenInput = $('[name="x-token"]');
    $("#form-login").submit(function (e) {
        e.preventDefault();
        
        const main = $(this);
        const btn = main.find('button[type="submit"]');
        const formData = new FormData(main[0]);
  
        $.ajax({
        url: main.attr("action"),
        type: "POST",
        data: formData,
        async: true,
        beforeSend: function () {
            btn.text("Loading...").prop("disabled", true);
            $(".error-input-feedback").html("");
        },
        success: function (data) {
            xTokenInput.val(data.hash);
            if (data.success) {
                toastr.success(data.message);
                setTimeout(() => {
                window.location.href = data.redirect;
                }, 1500);
            } else {
            if (data.errors) {
                $.each(data.errors, function (index, value) {
                main
                    .find("[name=" + index + "]")
                    .siblings(".error-input-feedback")
                    .html(value);
                });
            }
            if (data.message) {
                toastr.error(data.message);
            }
            }
        },
        complete: function () {
            btn.text("Login").prop("disabled", false);
        },
        cache: false,
        contentType: false,
        processData: false,
        });
        
    });
  
  
});