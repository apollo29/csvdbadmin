<?php
$data = $admin->database($_GET['db']);
$schema = $data->csvdb()->getSchema();

$item = array();
if (!empty($_GET['index'])) {
    $item = $data->csvdb()->select()->where([$data->csvdb()->index => $_GET['index']])->get()[0];
}

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

function getInputValue(string $type, string $value): string
{
    if (empty($value)) {
        return $value;
    }
    switch ($type) {
        case "date":
            return date("Y-m-t", strtotime($value));
        default:
            return $value;
    }
}

if (array_key_exists("history", $_GET) && !empty($_GET["history"])) {
    echo '<div class="alert alert-warning" role="alert">' . "\n";
    echo '<p><strong>Datensatz aus Datenbank History "'.$_GET["history"].'"</strong></p><p>Es wird ein Datensatz aus der Datenbank History bearbeitet.</p>' . "\n";
    echo '</div>' . "\n";
}
?>
<div class="table-responsive-lg">
    <table class="table table-light table-striped align-middle my-3 insertRowTable w-auto">
        <thead>
        <tr>
            <th>Spalte</th>
            <th>Typ</th>
            <th>Null</th>
            <th class="w-50">Wert</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th colspan="5" class="tblFooters text-end">
                <input class="btn btn-primary" type="submit" value="OK">
            </th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        foreach ($schema as $field => $structure) {
            ?>
            <tr class="noclick">
                <td class="text-center">
                    <?= $field ?>
                </td>
                <td class="text-center text-nowrap">
                    <span class="column_type" dir="ltr"><?= $structure["type"] ?></span>
                </td>
                <td>
                    <?php
                    if (array_key_exists("nullable", $structure) && $structure["nullable"]) {
                        echo '<input type="checkbox" class="checkbox_null" name="fields_null[<?= $field ?>]" aria-label="Verwenden Sie für diese Spalte den NULL-Wert." checked="checked">';
                    }
                    ?>
                </td>

                <td>
                    <?php
                    $value = "";
                    if (!empty($item)) {
                        $value = $item[$field];
                    } else if (array_key_exists("default", $structure) && !empty($structure["default"])) {
                        $default = $structure["default"];
                        echo '<span class="default_value hide">' . $structure["default"] . '</span>';
                    }
                    ?>
                    <input type="<?= getInputType($structure["type"]) ?>" name="fields[<?= $field ?>]"
                           value="<?= getInputValue($structure["type"], $value) ?>" class="textfield"/>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<fieldset class="pma-fieldset" id="actions_panel">
    <table class="table table-borderless w-auto tdblock">
        <tbody>
        <tr>
            <td class="text-nowrap align-middle">
                <select name="submit_type" class="control_at_footer valid" aria-invalid="false">
                    <option value="update">Speichern</option>
                    <option value="insert">Als neuen Datensatz speichern</option>
                    <option value="showinsert">Zeige Abfrage</option>
                </select>
            </td>
            <td class="align-middle">
                <strong>und dann</strong>
            </td>
            <td class="text-nowrap align-middle">
                <select name="after_insert" class="control_at_footer valid" aria-invalid="false">
                    <option value="back" selected="">zurück</option>
                    <option value="new_insert">anschliessend einen weiteren Datensatz einfügen</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-end align-middle">
                <input type="reset" class="btn btn-secondary control_at_footer" value="Zurücksetzen">
                <input type="submit" class="btn btn-primary control_at_footer" value="OK" id="buttonYes">
            </td>
        </tr>
        </tbody>
    </table>
</fieldset>