<?php
$data = $admin->databases();
?>
<h2>
    <span class="text-nowrap"><img src="themes/dot.gif" title="Datenbanken" alt="Datenbanken" class="icon ic_s_db">&nbsp;Datenbanken</span>
</h2>

<div class="d-flex flex-wrap my-3">
    <div>
        <div class="input-group">
            <div class="input-group-text">
                <div class="form-check mb-0">
                    <input class="form-check-input checkall_box" type="checkbox" value=""
                           id="checkAllCheckbox"
                           form="dbStatsForm">
                    <label class="form-check-label" for="checkAllCheckbox">Alle auswählen</label>
                </div>
            </div>
            <button class="btn btn-outline-secondary" id="bulkActionDropButton" type="submit"
                    name="submit_mult"
                    value="Drop" form="dbStatsForm" title="Löschen">
        <span class="text-nowrap"><img src="themes/dot.gif" title="Löschen" alt="Löschen"
                                       class="icon ic_b_drop">&nbsp;Löschen</span>
            </button>
        </div>
    </div>
</div>


<form class="ajax" action="index.php?route=/server/databases" method="post" name="dbStatsForm"
      id="dbStatsForm">
    <input type="hidden" name="statistics" value=""><input type="hidden" name="pos" value="0"><input
            type="hidden" name="sort_by" value="SCHEMA_NAME"><input type="hidden" name="sort_order"
                                                                    value="asc"><input
            type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
    <div class="table-responsive">
        <table class="table table-striped table-hover w-auto">
            <thead class="table-light">
            <tr>
                <th></th>
                <th><a href="#">Datenbank <img src="themes/dot.gif" title="Aufsteigend" alt="Aufsteigend"
                                               class="icon ic_s_asc"></a></th>
                <th>Encoding</th>
                <th>Aktion</th>
            </tr>
            </thead>

            <tbody>
            <?php
            foreach ($data as $database => $csvdb) {
            ?>
            <tr class="db-row" data-filter-row="<?= $database ?>">
                <td class="tool">
                    <input type="checkbox" name="selected_dbs[]" class="checkall" title="<?= $database ?>"
                           value="<?= $database ?>">
                </td>

                <td class="name">
                    <a href="index.php?route=/database/structure&amp;db=<?= $database ?>"
                       title="Springe zu Datenbank '<?= $database ?>'">
                        <?= $database ?>
                    </a>
                </td>

                <td class="value">
                    encoding?
                </td>

                <td class="tool">
                    <span class="text-nowrap"><img src="themes/dot.gif" title="Löschen" alt="Löschen"
                                                   class="icon ic_b_drop">&nbsp;Löschen</span>
                </td>
            </tr>
            <?php } ?>
            </tbody>

            <tfoot class="table-light">
            <tr>
                <th colspan="4">
                    Insgesamt: <span id="filter-rows-count"><?= count($data) ?></span>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</form>