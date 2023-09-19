<?php
$db = $admin->get_database($_GET);

$sql_query = "SELECT * FROM " . $db;

$error["class"] = "hide";
$error["message"] = "";
if (array_key_exists("index", $_GET) && array_key_exists("id_rows", $_GET)) {
    if (is_array($_GET["id_rows"]) && count($_GET["id_rows"]) > 0) {
        $sql_query = "SELECT * FROM " . $db . " WHERE " . $_GET["index"] . " IN ('" . implode("','", $_GET["id_rows"]) . "')";
    } else {
        $error["class"] = "";
        $error["message"] = "Es wurden keine Zeilen ausgewählt.";
    }
}

// error from export
if (array_key_exists("error", $_GET)) {
    $error["class"] = "";
    switch ($_GET["error"]) {
        case "export":
            $error["message"] = "Es wurde keine Datenbank ausgewählt.";
            break;
        default:
            $error["message"] = "Es ist ein unerwartetes Problem aufgetreten, bitte versuchen sie es erneut.";
    }
}
?>
<h2>Exportiere Datensätze aus Tabelle "<?= $db ?>"</h2>
<!-- ERROR -->
<div class="alert alert-danger <?= $error["class"] ?>" role="alert">
    <h3>Fehler</h3>
    <p><?= $error["message"] ?></p>
</div>

<form method="post" name="export" action="export.php">
    <input type="hidden" name="db_select" value="<?= $db ?>"/>
    <input type="hidden" name="sql_query" value="<?= $sql_query ?>"/>

    <div class="exportoptions">
        <h3>Format:</h3>
        <select id="format" name="format">
            <option selected="selected" value="csv">CSV</option>
            <option value="json">JSON</option>
            <option value="php">PHP array</option>
            <option value="sql">SQL</option>
        </select>
    </div>
    <div>
        <button class="btn btn-primary ms-1" type="submit" id="button_submit_export">OK</button>
    </div>
</form>