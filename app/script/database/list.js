$(document).ready(function () {
    $(".pageselector").change(function () {
        document.forms["pageselector"].submit();
    });

    $("#limit").change(function () {
        document.forms["limit"].submit();
    });

    $("#showAll").change(function () {
        document.forms["showAll"].submit();
    });

    $(".jsPrintButton").click(function () {
        window.print();
    });

    $(".requireConfirm").click(function () {
        let url = $(this).data("route");
        $("#delete_row").dialog({
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

    function confirmDialog(success) {
        var confirmdialog = $('#delete_row')
            .dialog({
                modal: true,
                autoOpen: false,
                buttons: {
                    "OK": function () {
                        success();
                        $(this).dialog("close");
                    },
                    "Abbrechen": function () {
                        $(this).dialog("close");
                    }
                }
            });

        return confirmdialog.dialog("open");
    }

    $('form[name="resultsForm"]').on('submit', function (e) {
        e.preventDefault();
        var form = this;

        confirmDialog(function () {
            form.submit();
        });
    });

    $(".inline_edit").click(function (){
        $("#sqlQuery").toggleClass("hide");
        $(".sql_query").toggleClass("hide");
    });

    $(".inline_edit_cancel").click(function (){
        $("#sqlQuery").toggleClass("hide");
        $(".sql_query").toggleClass("hide");
    });
});