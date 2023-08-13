<?php

use CSVDB\CSVDB;

$db = $admin->database($_GET['db']);
try {
    $config = $db->csvdb()->config;
} catch (Exception $e) {
    var_dump($e);
}
$filename = $_GET["history"];
$csvdb = $db->csvdb()->history_dir() . $filename;
$db = \CSVDB\Helpers\CSVUtilities::csv_database($csvdb);
try {
    $data = new CSVDB($csvdb, $config);
} catch (Exception $e) {
    var_dump($e);
}

$count = $data->count()->get()['count'];

$sql_query = "SELECT * FROM " . $db;
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}

$pos = 0;
if (!empty($_GET["pos"])) {
    $pos = (int)$_GET["pos"];
}
$limit = 25;
if (!empty($_GET["limit"])) {
    $limit = (int)$_GET["limit"];
}

$query = "$sql_query LIMIT $pos, $limit";
$rows = $data->query($query);

$maxrow = $pos + $limit;
if ($maxrow > count($rows)) {
    $maxrow = count($rows);
} else if ($maxrow > $count) {
    $maxrow = $count;
}

$showAll = false;
if (isset($_GET["showAll"]) && $_GET["showAll"] == "all") {
    $showAll = true;
    $maxrow = $count;
    $limit = 0;
    $query = $sql_query;
}
?>
<script src="script/database/list.js"></script>
<script src="script/database/sql.js"></script>
<div class="alert alert-warning" role="alert">
    <h3>Datenbank History: <?= $_GET["db"] ?></h3>
    <p>Aus der Datenbank History wird die Datei <strong><?= $db ?></strong> angezeigt und nicht die Original Datenbank.</p>
</div>

<div class="result_query">
    <div class="alert alert-success" role="alert">
        <img src="themes/dot.gif" title="" alt="" class="icon ic_s_success"> Zeige Datensätze <?= $pos ?>
        - <?= $maxrow - 1 ?> (<?= $count ?> insgesamt)
    </div>

    <div class="sqlOuter">
        <pre class="sql_query"><code class="language-sql"><?= $sql_query ?></code></pre>

        <form method="get" name="sqlQuery" class="hide" id="sqlQuery">
            <input type="hidden" name="route" value="<?= $_GET["route"] ?>">
            <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
            <input type="hidden" name="history" value="<?= $_GET["history"] ?>">

            <div>
                <div id="editor" class="sql-editor"><?= $sql_query ?></div>
                <textarea class="hide" name="sql_query" id="sql_query"><?= $sql_query ?></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary ms-1" type="submit" id="button_submit_query" name="SQL">OK</button>
                <button class="btn inline_edit_cancel ms-1" type="button">Abbrechen</button>
            </div>
        </form>
    </div>
    <div class="tools d-print-none">
        [&nbsp;<a href="#" class="inline_edit">Inline Bearbeiten</a>&nbsp;]
        [&nbsp;<a
                href="index.php?route=<?= $_GET["route"] ?>&db=<?= $_GET["db"] ?>&history=<?= $_GET["history"] ?>&sql_query=<?= $sql_query ?>&pos=<?= $pos ?>&limit=<?= $limit ?>">Aktualisieren</a>&nbsp;]
    </div>
</div>
<!-- DATABASE NAVIGATION -->
<?php
include "list_navigation.php";
?>

<!-- DATABASE -->
<div class="table-responsive-md">
    <table class="table table-light table-striped table-hover table-sm table_results ajax w-auto pma_table">
        <thead class="table-light">
        <tr>
            <th class="column_action position-sticky d-print-none" colspan="3"></th>
            <?php
            $headers = $data->headers();
            foreach ($headers as $header) {
                echo '<th class="text column_heading marker pointer" data-column="' . $header . '">' . "\n";
                echo '<span><a href="#" class="sortlink">' . $header . '</a></span>' . "\n";
                echo '</th>' . "\n";
            }
            ?>
        </tr>
        </thead>

        <tbody>
        <?php
        $i = 0;
        foreach ($rows as $item) { ?>
            <tr>
                <td class="text-center d-print-none">
                    <span>
                        <input type="checkbox" class="multi_checkbox checkall" id="id_rows<?= $i ?>"
                               name="id_rows[]" value="<?= $item[$data->index] ?>">
                    </span>
                </td>

                <td class="text-center d-print-none">
                    <span class="text-nowrap">
                        <a href="index.php?route=/database/change&db=<?= $_GET["db"] ?>&history=<?= $_GET["history"] ?>&index=<?= $item[$data->index] ?>&action=insert">
                            <span class="text-nowrap">
                                <img src="themes/dot.gif" title="Kopieren" alt="Kopieren" class="icon ic_b_insrow">&nbsp;Kopieren
                            </span>
                        </a>
                    </span>
                </td>

                <td class="text-center d-print-none">
                    <span class="text-nowrap">
                        <a href="#" class="restore" data-index="<?= $item[$data->index] ?>" data-history="<?= $_GET["history"] ?>" data-database="<?= $_GET["db"] ?>">
                            <span class="text-nowrap">
                                <img src="themes/dot.gif" title="Kopieren" alt="Kopieren" class="icon ic_s_replication">&nbsp;Wiederherstellen
                            </span>
                        </a>
                    </span>
                </td>
                <?php
                foreach ($item as $field) {
                    echo '<td class="text data grid_edit click2 not_null text-nowrap"><span>' . $field . '</span></td>' . "\n";
                }
                ?>
            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>

<!-- ACTIONS -->
<div class="d-print-none">
    <img class="selectallarrow" src="./themes/img/arrow_ltr.png" width="38" height="22" alt="markierte:">
    <input type="checkbox" id="checkall" class="checkall_box" title="Alle auswählen">
    <label for="checkall">Alle auswählen</label>
    <em class="with-selected">markierte:</em>

    <button class="btn btn-link mult_submit" type="submit" name="route" value="/database/export"
            title="Exportieren">
            <span class="text-nowrap"><img src="themes/dot.gif" title="Exportieren" alt="Exportieren"
                                           class="icon ic_b_tblexport">&nbsp;Exportieren</span>
    </button>
</div>
<!-- DATABASE NAVIGATION -->
<?php
include "list_navigation.php";
?>

<!-- FIELDSET -->
<fieldset class="pma-fieldset d-print-none">
    <legend>Operationen für das Abfrageergebnis</legend>

    <div>
        <button type="button" class="btn btn-link jsPrintButton">
        <span class="text-nowrap">
            <img src="themes/dot.gif" title="Drucken" alt="Drucken" class="icon ic_b_print">&nbsp;Drucken
        </span>
        </button>

        <a href="index.php?route=/database/export&db=<?= $_GET["db"] ?>&history=<?= $_GET["history"] ?>&sql_query=<?= $sql_query ?>" class="btn">
        <span class="text-nowrap">
            <img src="themes/dot.gif" title="Exportieren" alt="Exportieren" class="icon ic_b_tblexport">&nbsp;Exportieren
        </span>
        </a>
    </div>
</fieldset>