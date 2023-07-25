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

    $(".jsPrintButton").click(function (){
        window.print();
    });

    $(".requireConfirm").click(function () {
        $("#delete_row").dialog({
            modal: true,
            buttons: {
                "OK": function() {
                    $( this ).dialog( "close" );
                },
                "Abbrechen": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
});