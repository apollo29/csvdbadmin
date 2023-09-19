$(document).ready(function () {
    $(".select_all_db").click(function () {
        $('#db_select option').prop('selected', true);
    });

    $(".unselect_all_db").click(function () {
        $('#db_select option').prop('selected', false);
    });
});