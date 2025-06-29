$(function () {
  "use strict";
  var dtEmployee;
  var xTokenInput = $('[name="x-token"]');
  $("#form-new-employee").submit(function (e) {
      e.preventDefault();
      
      const main = $(this);
      const btn = main.find('button[type="submit"]');
      const formData = new FormData(main[0]);

      $.confirm({
        title: "Confirm Submission",
        content: "Are you sure you want to submit this form?",
        type: "blue",
        buttons: {
          confirm: {
            text: "Yes, Submit",
            btnClass: "btn-blue",
            action: function () {
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
                   
                    $.confirm({
                      title: "Success!",
                      content: data.message,
                      autoClose: "ok|1000",
                      type: "green",
                      buttons: {
                        ok: {
                          text: "OK",
                          btnClass: "btn-green",
                          action: function () { window.location.href=baseUrl + 'admin/employee';},
                        },
                      },
                    });
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
                      alert(data.message);
                    }
                  }
                },
                complete: function () {
                  btn.text("Submit").prop("disabled", false);
                },
                cache: false,
                contentType: false,
                processData: false,
              });
            }
          },
          cancel: function () {
          }
        }
      });
      
  });


  if ($("#dtEmployee").length) {
    dtEmployee = $("#dtEmployee").DataTable({
      lengthMenu: [
        [20, 50, 70, 100],
        [20, 50, 70, 100],
      ],
      keys: true,
      language: {
        paginate: {
          previous: "<i class='fas fa-chevron-left'></i>",
          next: "<i class='fas fa-chevron-right'></i>",
        },
      },
      processing: true,
      serverSide: true,
      searching: false,
      responsive: true,
      searchDelay: 500,
      lengthChange: true,
      stateSave: true,
      serverMethod: "get",
      info: true,
      ajax: {
        url: `${baseUrl}admin/employee/get-employee-list`,
        data: function (data) {
          return data;
        },
        dataSrc: "aaData",
      },

      columns: [
        { data: "slNo", orderable: false, searchable: false },
        { data: "name", orderable: false, searchable: false },
        { data: "designation", orderable: false, searchable: false },
        { data: "salary", orderable: false, searchable: false },
        { data: "picture", orderable: false, searchable: false },
        { data: "created_date", orderable: false, searchable: false },
        { data: "action", orderable: false, searchable: false },
      ],
    });
  }

  $(document).on("click", ".delete-employee", function () {
    const id = $(this).data("id");
  
    $.confirm({
      title: "Are you sure?",
      content: "This action will permanently delete the employee record.",
      type: "red",
      buttons: {
        confirm: {
          text: "Yes, Delete",
          btnClass: "btn-red",
          action: function () {
            $.ajax({
              url: `${baseUrl}admin/employee/delete-employee/${id}`,
              type: "POST",
              dataType: "json",
              data: {
                csrf_test_name: xTokenInput.val()
              },
              success: function (res) {
                if (res.success) {
                  $.confirm({
                    title: "Deleted!",
                    content: res.message,
                    autoClose: "ok|1000",
                    type: "green",
                    buttons: {
                      ok: {
                        text: "OK",
                        btnClass: "btn-green",
                        action: function () {},
                      },
                    },
                  });
                  
                  dtEmployee.draw(false);
                } else {
                  $.alert({
                    title: "Error!",
                    content: res.message || "Something went wrong.",
                    type: "red"
                  });
                }
            
                // Update CSRF token
                xTokenInput.val(res.hash);
              },
              error: function () {
                $.alert("Server error occurred.");
              }
            });            
          }
        },
        cancel: {
          text: "Cancel",
          btnClass: "btn-secondary"
        }
      }
    });
  });
  
  $("#form-edit-employee").submit(function (e) {
      e.preventDefault();
      
      const main = $(this);
      const btn = main.find('button[type="submit"]');
      const formData = new FormData(main[0]);

      $.confirm({
        title: "Confirm Submission",
        content: "Are you sure you want to submit this form?",
        type: "blue",
        buttons: {
          confirm: {
            text: "Yes, Submit",
            btnClass: "btn-blue",
            action: function () {
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
                  
                    $.confirm({
                      title: "Success!",
                      content: data.message,
                      autoClose: "ok|1000",
                      type: "green",
                      buttons: {
                        ok: {
                          text: "OK",
                          btnClass: "btn-green",
                          action: function () { window.location.href=baseUrl + 'admin/employee';},
                        },
                      },
                    });
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
                      alert(data.message);
                    }
                  }
                },
                complete: function () {
                  btn.text("Submit").prop("disabled", false);
                },
                cache: false,
                contentType: false,
                processData: false,
              });
            }
          },
          cancel: function () {
          }
        }
      });
      
  });

});