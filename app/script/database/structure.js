$(document).ready(function () {
    $(".rename_field").click(function () {
        $("#rename_field_value").val($(this).data("field"));
        $("#rename_field_name").val($(this).data("field"));
        new bootstrap.Modal('#rename_field').show();
    });

    $(".requireInput").click(function () {
        console.log($(this).data("field"), $(this).data("field-value"), $(this).data("title"));
        $("#field_value").val($(this).data("field-value"));
        $("#field_name").val($(this).data("field"));
        $("#field_action").val($(this).data("action"));
        $("#requireInput .modal_title").append($(this).data("title"));
        new bootstrap.Modal('#requireInput').show();
    });

    $(".requireConfirm").click(function () {
        let url = $(this).data("route");
        $("#delete_index").dialog({
            modal: true,
            buttons: {
                "OK": function () {
                    $(this).dialog("close");
                    window.location.href = url;
                },
                "Abbrechen": function () {
                    $(this).dialog("close");
                }
            }
        });
    });
});