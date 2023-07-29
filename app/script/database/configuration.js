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

    var aceEditor = ace.edit("editor");
    aceEditor.session.setMode("ace/mode/json");
    var textarea = $('textarea[name="schema"]');
    aceEditor.session.on("change", function () {
        textarea.val(aceEditor.session.getValue());
    });
});