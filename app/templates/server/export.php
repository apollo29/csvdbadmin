<?php
$error["class"] = "hide";
$error["message"] = "";
// error from export
if (array_key_exists("error", $_GET)) {
    $error["class"] = "";
    switch ($_GET["error"]) {
        case "export":
            $error["message"] = "Es wurde(n) keine Datenbank(n) ausgewählt.";
            break;
        default:
            $error["message"] = "Es ist ein unerwartetes Problem aufgetreten, bitte versuchen sie es erneut.";
    }
}
?>
<script src="script/server/export.js"></script>
<h2>Datenbanken des aktuell ausgewählten Servers exportieren</h2>
<!-- ERROR -->
<div class="alert alert-danger <?= $error["class"] ?>" role="alert">
    <h3>Fehler</h3>
    <p><?= $error["message"] ?></p>
</div>

<form method="post" name="export" action="export.php">
    <input type="hidden" name="filename" value="<?= $_SERVER['SERVER_NAME'] ?>"/>

    <div class="exportoptions">
        <h3>Datenbanken:</h3>
        <div>
            <p>
                <a href="#" class="select_all_db">Alle auswählen</a> /
                <a href="#" class="unselect_all_db">Auswahl entfernen</a>
            </p>

            <select name="db_select[]" id="db_select" size="5" multiple="">
                <?php
                $databases = $admin->databases();
                foreach ($databases as $database => $csvdb) {
                    echo '<option value="' . $database . '">' . "\n";
                    echo $database . "\n";
                    echo '</option>' . "\n";
                }
                ?>
            </select>
        </div>
    </div>
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