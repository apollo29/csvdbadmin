$(document).ready(function () {
    $(".rename_field").click(function () {
        $("#rename_field_value").val($(this).data("field"));
        $("#rename_field_name").val($(this).data("field"));
        const modal = new bootstrap.Modal('#rename_field');
        modal.show();
    });

    $(".add_comment").click(function () {
        $("#comment_value").val($(this).data("comment"));
        $("#comment_field_name").val($(this).data("field"));
        const modal = new bootstrap.Modal('#add_comment');
        modal.show();
    });

    $(".add_default").click(function () {
        $("#default_value").val($(this).data("default"));
        $("#default_field_name").val($(this).data("field"));
        const modal = new bootstrap.Modal('#default_value');
        modal.show();
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