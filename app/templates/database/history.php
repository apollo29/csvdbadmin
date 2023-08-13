<?php
$data = $admin->database($_GET['db']);
$hasHistory = $data->csvdb()->config->history;

if (!$hasHistory) {
    echo '<div class="alert alert-warning" role="alert">' . "\n";
    echo '<p><strong>History</strong> ist deaktiviert.</p><p>Für diese CSVDB gibt es keine History.</p>' . "\n";
    echo '</div>' . "\n";
}
?>

<div class="table-responsive-md">
    <table class="table table-light table-striped table-hover table-sm table_results ajax w-auto pma_table">
        <thead class="table-light">
        <tr>
            <th class="column_action position-sticky d-print-none"></th>
            <th class="text column_heading marker pointer">Datei</th>
            <th class="text column_heading marker pointer">Datum</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $files = $data->history();
        foreach ($files as $filename => $file) {
            if (is_file($file)) {
                $download_file = str_replace(__DIR__, "", $file);
                echo "<tr>\n";
                echo '<td class="text-center d-print-none"><a href="index.php?route=/database/history/list&db=' . $_GET["db"] . '&history=' . $filename . '"><img src="themes/dot.gif" title="Anzeigen" alt="Anzeigen" class="icon ic_b_browse">&nbsp;Anzeigen</a></td>' . "\n";
                echo '<td class="text-center text-nowrap">' . $filename . '</td>' . "\n";
                echo '<td class="text-center text-nowrap">' . date("d.m.Y H:i:s", filectime($file)) . '</td>' . "\n";
                echo "</tr>\n";
            }
        }
        ?>
        </tbody>
    </table>
</div>
