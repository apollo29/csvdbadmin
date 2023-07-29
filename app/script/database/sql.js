$(document).ready(function () {
    var aceEditor = ace.edit("editor");
    aceEditor.session.setMode("ace/mode/csvdb");
    var textarea = $('textarea[name="sql_query"]');
    aceEditor.session.on("change", function () {
        textarea.val(aceEditor.session.getValue());
    });
});