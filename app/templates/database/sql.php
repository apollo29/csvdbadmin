<?php
$sql_query = "SELECT * FROM ".$_GET["db"];
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}

?>
<div class="card mb-3">
    <div class="card-header">
        SQL-Befehl(e) in Datenbank <a href="index.php?route=/database/list&amp;db=<?= $_GET["db"] ?>"><?= $_GET["db"] ?></a> ausführen:
    </div>
    <div class="card-body">
        <div id="queryfieldscontainer">
            <div class="mb-3">
                <textarea class="form-control" tabindex="100" name="sql_query" id="sqlquery" cols="40" rows="15" aria-label="SQL-Befehl"><?= $sql_query ?></textarea>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <input class="btn btn-primary ms-1" type="submit" id="button_submit_query" name="SQL" tabindex="200" value="OK">
    </div>
</div>