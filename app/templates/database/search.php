<?php
$data = $admin->database($_GET['db']);
$types = $data->csvdb()->getDatatypes();
?>
<form method="post" action="index.php?route=/table/search" name="insertForm" id="tbl_search_form" class="ajax lock-page">
    <input type="hidden" name="db" value="annodomini_dev">
    <input type="hidden" name="table" value="account">
    <input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
    <input type="hidden" name="goto" value="">
    <input type="hidden" name="back" value="index.php?route=/table/search">

    <div class="card">
        <div class="card-header">Suche über Abfrage-durch-Beispiel ("query by example") (Platzhalter: "%")</div>

        <div class="card-body">
            <div id="fieldset_table_qbe">
                <div class="table-responsive-md jsresponsive">
                    <table class="table table-light table-striped table-hover table-sm w-auto">
                        <thead class="table-light">
                        <tr>
                            <th>Spalte</th>
                            <th>Typ</th>
                            <th>Operator</th>
                            <th>Wert</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $i=0;
                        foreach ($types as $field => $type) {
                        ?>
                        <tr class="noclick">
                            <th><?= $field ?></th>
                            <td dir="ltr">
                                <?= $type ?>
                            </td>
                            <td>
                                <select class="column-operator" id="ColumnOperator<?= $i ?>" name="criteriaColumnOperators[<?= $i ?>]">
                                    <option value="=">=</option>
                                    <option value=">">&gt;</option>
                                    <option value=">=">&gt;=</option>
                                    <option value="<">&lt;</option>
                                    <option value="<=">&lt;=</option>
                                    <option value="!=">!=</option>
                                    <option value="LIKE">LIKE</option>
                                    <option value="LIKE %...%">LIKE %...%</option>
                                    <option value="NOT LIKE">NOT LIKE</option>
                                    <option value="NOT LIKE %...%">NOT LIKE %...%</option>
                                    <option value="IS NULL">IS NULL</option>
                                    <option value="IS NOT NULL">IS NOT NULL</option>
                                </select>

                            </td>
                            <td data-type="<?= $type ?>">
                                <input type="text" name="criteriaValues[<?= $i ?>]" size="40" class="textfield" id="fieldID_<?= $i ?>">

                                <input type="hidden" name="criteriaColumnNames[<?= $i ?>]" value="<?= $field ?>">
                                <input type="hidden" name="criteriaColumnTypes[<?= $i ?>]" value="<?= $type ?>">
                            </td>
                        </tr>
                        <?php
                            $i++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input class="btn btn-primary" type="submit" name="submit" value="OK">
        </div>
    </div>
</form>