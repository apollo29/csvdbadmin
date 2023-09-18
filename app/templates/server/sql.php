<?php

// todo sql syntax checker und highlighter --> ACE

$sql_query = "";
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}
?>
<script src="script/database/sql.js"></script>
<form method="get" name="sqlQuery" id="sqlQuery">
    <input type="hidden" name="route" value="/database/list">

    <div class="card mb-3">
        <div class="card-header">
            SQL-Befehl(e) auf Server <a href="index.php?route=/server/databases">"<?= $_SERVER['SERVER_NAME'] ?>"</a> ausführen:
        </div>
        <div>
            <div id="editor" class="sql-editor"><?= $sql_query ?></div>
            <textarea class="hide" name="sql_query" id="sql_query"><?= $sql_query ?></textarea>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary ms-1" type="submit" id="button_submit_query">OK</button>
        </div>
    </div>
</form>