<?php

use League\Csv\InvalidArgument;

$db = $admin->get_database($_GET);
$data = $admin->database($db);

if (!empty($_GET["id_rows"])) {
    foreach ($_GET["id_rows"] as $index) {
        try {
            $data->csvdb()->delete([$data->csvdb()->index => $index]);
        } catch (InvalidArgument|\League\Csv\Exception|Exception $e) {
            // todo show error
            var_dump($e);
        }
    }
}

$count = $data->csvdb()->count()->get()['count'];

$sql_query = "SELECT * FROM " . $db;
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}

if ($_POST) {
    if (!empty($_POST["action"]) && $_POST["action"] == "search") {
        $where = "";
        for ($i = 0; $i < count($_POST["criteriaValues"]); $i++) {
            $value = $_POST["criteriaValues"][$i];
            $operator = $_POST["criteriaColumnOperators"][$i];
            // todo operator "IS NULL"
            if (!empty($value)) {
                $name = $_POST["criteriaColumnNames"][$i];
                $type = $_POST["criteriaColumnTypes"][$i];
                if ($type == "string") {
                    if ($operator == "LIKE %...%") {
                        $value = "'%" . $value . "%'";
                    } else {
                        $value = "'" . $value . "'";
                    }
                }
                if ($operator == "LIKE %...%") {
                    $operator = "LIKE";
                }
                if (!empty($where)) {
                    $where .= " AND";
                }
                $where .= " $name $operator $value";
            }
        }

        if (!empty($where)) {
            $sql_query = "SELECT * FROM " . $db . " WHERE" . $where;
        }
    }
}

if (!empty($_GET["order"])) {
    $direction = "ASC";
    if (!empty($_GET["order_direction"])) {
        $direction = $_GET["order_direction"];
    }

    if (str_contains($sql_query,"ORDER BY")){
        $test = substr($sql_query, stripos($sql_query, "ORDER BY"));
        $sql_query = str_replace($test, "ORDER BY ".$_GET["order"]." ".$direction, $sql_query);
    }
    else {
        $sql_query = "$sql_query ORDER BY ".$_GET["order"]." ".$direction;
    }
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
$rows = $data->csvdb()->query($query)->get();

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
<div class="result_query">
    <div class="alert alert-success" role="alert">
        <img src="themes/dot.gif" title="" alt="" class="icon ic_s_success"> Zeige Datensätze <?= $pos ?>
        - <?= $maxrow - 1 ?> (<?= $count ?> insgesamt)
    </div>

    <div class="sqlOuter">
        <pre class="sql_query"><code class="language-sql"><?= $sql_query ?></code></pre>

        <form method="get" name="sqlQuery" class="hide" id="sqlQuery">
            <input type="hidden" name="route" value="/database/list">
            <input type="hidden" name="db" value="<?= $db ?>">
            <input type="hidden" name="pos" value="<?= $pos ?>">
            <input type="hidden" name="limit" value="<?= $limit ?>">

            <div>
                <div id="editor" class="sql-editor"><?= $sql_query ?></div>
                <textarea class="hide" name="sql_query" id="sql_query"><?= $sql_query ?></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary ms-1" type="submit" id="button_submit_query">OK</button>
                <button class="btn inline_edit_cancel ms-1" type="button">Abbrechen</button>
            </div>
        </form>
    </div>
    <div class="tools d-print-none">
        [&nbsp;<a href="#" class="inline_edit">Inline Bearbeiten</a>&nbsp;]
        [&nbsp;<a href="index.php?route=/database/sql&db=<?= $db ?>&sql_query=<?= $sql_query ?>">Bearbeiten</a>&nbsp;]
        [&nbsp;<a
                href="index.php?route=/database/list&db=<?= $db ?>&sql_query=<?= $sql_query ?>&pos=<?= $pos ?>&limit=<?= $limit ?>">Aktualisieren</a>&nbsp;]
    </div>
</div>
<!-- DATABASE NAVIGATION -->
<?php
include "list_navigation.php";
?>

<!-- DATABASE -->
<form method="get" name="resultsForm">
    <input type="hidden" name="route" value="/database/list">
    <input type="hidden" name="db" value="<?= $db ?>">
    <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
    <input type="hidden" name="pos" value="<?= $pos ?>">
    <input type="hidden" name="limit" value="<?= $limit ?>">
    <input type="hidden" name="index" value="<?= $data->csvdb()->index ?>">

    <div class="table-responsive-md">
        <table class="table table-light table-striped table-hover table-sm table_results ajax w-auto pma_table">
            <thead class="table-light">
            <tr>
                <th class="column_action position-sticky d-print-none" colspan="4"></th>
                <?php
                $headers = $data->csvdb()->headers();
                $row_headers = array_keys($rows[0]);
                if (count($headers) != count($row_headers)){
                    $headers = $row_headers;
                }

                foreach ($headers as $header) {
                    $order_direction = "ASC";
                    if ($_GET["order"]==$header) {
                        $order_direction = "DESC";
                    }
                    echo '<th class="text column_heading marker pointer" data-column="' . $header . '">' . "\n";
                    echo '<span><a href="index.php?route=/database/list&db='. $db .'&sql_query='. $sql_query .'&order='.$header.'&order_direction='.$order_direction.'" class="sortlink sorticon">' . $header . '</a></span>' . "\n";
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
                               name="id_rows[]" value="<?= $item[$data->csvdb()->index] ?>">
                    </span>
                    </td>

                    <td class="text-center d-print-none edit_row_anchor">
                    <span class="text-nowrap">
                        <a href="index.php?route=/database/change&db=<?= $db ?>&index=<?= $item[$data->csvdb()->index] ?>&action=update">
                            <span class="text-nowrap">
                                <img src="themes/dot.gif" title="Bearbeiten" alt="Bearbeiten" class="icon ic_b_edit">&nbsp;Bearbeiten
                            </span>
                        </a>
                    </span>
                    </td>

                    <td class="text-center d-print-none">
                    <span class="text-nowrap">
                        <a href="index.php?route=/database/change&db=<?= $db ?>&index=<?= $item[$data->csvdb()->index] ?>&action=insert">
                            <span class="text-nowrap">
                                <img src="themes/dot.gif" title="Kopieren" alt="Kopieren" class="icon ic_b_insrow">&nbsp;Kopieren
                            </span>
                        </a>
                    </span>
                    </td>

                    <td class="text-center d-print-none ajax">
                    <span class="text-nowrap">
                        <a href="#" class="delete_row requireConfirm"
                           data-route="index.php?route=/database/list&db=<?= $db ?>&pos=<?= $pos ?>&limit=<?= $limit ?>&id_rows[]=<?= $item[$data->csvdb()->index] ?>">
                            <span class="text-nowrap">
                                <img src="themes/dot.gif" title="Löschen" alt="Löschen" class="icon ic_b_drop">&nbsp;Löschen
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

        <button class="btn btn-link mult_submit delete_rows" type="button" name="action" value="delete" title="Löschen"
                data-route="">
            <span class="text-nowrap"><img src="themes/dot.gif" title="Löschen" alt="Löschen" class="icon ic_b_drop">&nbsp;Löschen</span>
        </button>

        <button class="btn btn-link mult_submit" type="submit" name="route" value="/database/export"
                title="Exportieren">
            <span class="text-nowrap"><img src="themes/dot.gif" title="Exportieren" alt="Exportieren"
                                           class="icon ic_b_tblexport">&nbsp;Exportieren</span>
        </button>
    </div>
</form>
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

        <a href="index.php?route=/database/export&db=<?= $db ?>&sql_query=<?= $sql_query ?>" class="btn">
        <span class="text-nowrap">
            <img src="themes/dot.gif" title="Exportieren" alt="Exportieren" class="icon ic_b_tblexport">&nbsp;Exportieren
        </span>
        </a>
    </div>
</fieldset>

<div id="delete_row" title="Fortfahren" class="hide">
    <p>Möchten Sie diese Zeile(en) wirklich löschen?</p>
</div>