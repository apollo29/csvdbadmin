<?php
$data = $admin->database($_GET['db']);
$types = $data->csvdb()->getDatatypes();

function getInputType(string $type): string
{
    switch ($type) {
        case "integer":
            return "number";
        case "date":
        case "time":
            return $type;
        default:
            return "text";
    }
}
?>
<form method="post" action="index.php?route=/database/list&db=<?= $_GET["db"] ?>" name="insertForm" id="tbl_search_form" class="ajax lock-page">
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
                        $i = 0;
                        foreach ($types as $field => $type) {
                            ?>
                            <tr class="noclick">
                                <th><?= $field ?></th>
                                <td dir="ltr">
                                    <?= $type ?>
                                </td>
                                <td>
                                    <select class="column-operator" id="ColumnOperator<?= $i ?>"
                                            name="criteriaColumnOperators[<?= $i ?>]">
                                        <option value="=">=</option>
                                        <option value="!=">!=</option>
                                        <option value="LIKE" <?= ($type == "string") ? 'selected="selected"' : "" ?>>
                                            LIKE
                                        </option>
                                        <option value="LIKE %...%">LIKE %...%</option>
                                        <option value="IS NULL">IS NULL</option>
                                    </select>

                                </td>
                                <td data-type="<?= $type ?>">
                                    <input type="<?= getInputType($type) ?>" name="criteriaValues[<?= $i ?>]" size="40"
                                           class="textfield" id="fieldID_<?= $i ?>">
                                    <input type="hidden" name="criteriaColumnNames[<?= $i ?>]" value="<?= $field ?>">
                                    <input type="hidden" name="criteriaColumnTypes[<?= $i ?>]" value="<?= $type ?>">
                                    <input type="hidden" name="action" value="search">
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