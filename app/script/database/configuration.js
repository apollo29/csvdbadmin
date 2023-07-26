$(document).ready(function () {
    $(".requireConfirm").click(function () {
        let url = $(this).data("route");
        $("#delete_file").dialog({
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