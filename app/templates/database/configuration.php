<?php

use CSVDB\Helpers\CSVConfig;

if ($_POST) {
    if (array_key_exists("action", $_POST)) {
        if ($_POST["action"] == "config") {
            $admin->storeConfig($_POST, $_GET["db"]);
        } else if ($_POST["action"] == "schema") {
            $admin->storeSchema($_POST['schema'], $_GET["db"]);
        }
    }
}

if (array_key_exists("delete", $_GET)) {
    if ($_GET["delete"] == "config") {
        $admin->deleteConfig($_GET["db"]);
    } else if ($_GET["delete"] == "schema") {
        $admin->deleteSchema($_GET["db"]);
    }
}

$data = $admin->database($_GET['db']);
$default = CSVConfig::default();
$headers = $data->csvdb()->headers();
$config = $data->csvdb()->config;
?>
<script src="script/database/configuration.js"></script>
<div class="d-flex">
    <div class="w-50">
        <h2>Konfiguration: <?= $_GET["db"] ?></h2>

        <form name="config" method="post">
            <div class="card mb-3 w-fit-content">
                <div class="card-header">
                    <?= $data->hasConfig() ? $data->configFile() : 'keine Konfiguration; default Werte' ?>
                </div>
                <div class="table-responsive-lg">
                    <table class="table table-light table-striped align-middle my-3 insertRowTable w-auto">
                        <thead>
                        <tr>
                            <th>Konfiguration</th>
                            <th>Default</th>
                            <th class="w-50">Wert</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="noclick">
                            <td class="text-center">
                                index
                            </td>
                            <td class="text-center text-nowrap">
                                <span class="column_type fst-italic" dir="ltr"><?= $default->index ?></span>
                            </td>
                            <td>
                                <select id="index" name="index">
                                    <?php
                                    foreach ($headers as $index => $header) {
                                        $selected = "";
                                        if ($index == $config->index) {
                                            $selected = 'selected="selected"';
                                        }
                                        echo '<option value="' . $index . '" ' . $selected . '>' . $header . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="noclick">
                            <td class="text-center">
                                encoding
                            </td>
                            <td class="text-center text-nowrap">
                                <span class="column_type fst-italic" dir="ltr"><?= $default->encoding ?></span>
                            </td>
                            <td>
                                <select id="encoding" name="encoding">
                                    <?php
                                    foreach (mb_list_encodings() as $encoding) {
                                        $selected = "";
                                        if (strtolower($encoding) == strtolower($config->encoding)) {
                                            $selected = 'selected="selected"';
                                        }
                                        echo '<option value="' . $encoding . '" ' . $selected . '>' . $encoding . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr class="noclick">
                            <td class="text-center">
                                delimiter
                            </td>
                            <td class="text-center text-nowrap">
                                <span class="column_type fst-italic" dir="ltr"><?= $default->delimiter ?></span>
                            </td>
                            <td>
                                <input type="text" maxlength="1" name="delimiter"
                                       value="<?= $config->delimiter ?>"/>
                            </td>
                        </tr>
                        <tr class="noclick">
                            <td class="text-center">
                                headers
                            </td>
                            <td class="text-center text-nowrap">
                                    <span class="column_type fst-italic"
                                          dir="ltr"><?= $default->headers ? 'true' : 'false' ?></span>
                            </td>
                            <td>
                                <?php
                                $headers_true = $config->headers ? 'checked="checked"' : '';
                                $headers_false = !$config->headers ? 'checked="checked"' : '';
                                ?>
                                <input type="radio" name="headers" value="true" <?= $headers_true ?> /> true
                                <input type="radio" name="headers" value="false" <?= $headers_false ?> /> false
                            </td>
                        </tr>
                        <tr class="noclick">
                            <td class="text-center">
                                cache
                            </td>
                            <td class="text-center text-nowrap">
                                    <span class="column_type fst-italic"
                                          dir="ltr"><?= $default->cache ? 'true' : 'false' ?></span>
                            </td>
                            <td>
                                <?php
                                $cache_true = $config->cache ? 'checked="checked"' : '';
                                $cache_false = !$config->cache ? 'checked="checked"' : '';
                                ?>
                                <input type="radio" name="cache" value="true" <?= $cache_true ?> /> true
                                <input type="radio" name="cache" value="false" <?= $cache_false ?> /> false
                            </td>
                        </tr>
                        <tr class="noclick">
                            <td class="text-center">
                                history
                            </td>
                            <td class="text-center text-nowrap">
                                    <span class="column_type fst-italic"
                                          dir="ltr"><?= $default->history ? 'true' : 'false' ?></span>
                            </td>
                            <td>
                                <?php
                                $history_true = $config->history ? 'checked="checked"' : '';
                                $history_false = !$config->history ? 'checked="checked"' : '';
                                ?>
                                <input type="radio" name="history" value="true" <?= $history_true ?> /> true
                                <input type="radio" name="history" value="false" <?= $history_false ?> /> false
                            </td>
                        </tr>
                        <tr class="noclick">
                            <td class="text-center">
                                autoincrement
                            </td>
                            <td class="text-center text-nowrap">
                                    <span class="column_type fst-italic"
                                          dir="ltr"><?= $default->autoincrement ? 'true' : 'false' ?></span>
                            </td>
                            <td>
                                <?php
                                $autoincrement_true = $config->autoincrement ? 'checked="checked"' : '';
                                $autoincrement_false = !$config->autoincrement ? 'checked="checked"' : '';
                                ?>
                                <input type="radio" name="autoincrement" value="true" <?= $autoincrement_true ?> /> true
                                <input type="radio" name="autoincrement" value="false" <?= $autoincrement_false ?> />
                                false
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex">
                    <div>
                        <?php
                        $disabled_config = "";
                        if (!$data->hasConfig()) {
                            $disabled_config = 'disabled="disabled"';
                        }
                        ?>
                        <button class="btn btn-warning ms-1 requireConfirm" type="button" id="button_delete_config"
                                data-route="index.php?route=/database/configuration&db=<?= $_GET["db"] ?>&delete=config" <?= $disabled_config ?>>
                            Löschen
                        </button>
                    </div>
                    <div class="text-end flex-grow-1">
                        <input type="hidden" name="action" value="config"/>
                        <button class="btn btn-secondary ms-1" type="reset" id="button_reset_config">Zurücksetzen
                        </button>
                        <button class="btn btn-primary ms-1" type="submit" id="button_submit_config">OK</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="w-50">
        <h2>Schema: <?= $_GET["db"] ?></h2>

        <form name="schema" method="post">
            <div class="card mb-3">
                <div class="card-header">
                    <?= $data->hasSchema() ? $data->schemaFile() : 'Kein Schema; default Werte' ?>
                </div>
                <div>
                    <div id="editor" class="editor"><?= json_encode($data->csvdb()->getSchema(), JSON_PRETTY_PRINT) ?></div>
                    <textarea class="hide" name="schema" id="schema"><?= json_encode($data->csvdb()->getSchema(), JSON_PRETTY_PRINT) ?></textarea>
                </div>
                <div class="card-footer d-flex">
                    <div>
                        <?php
                            $disabled_schema = "";
                            if (!$data->hasSchema()) {
                                $disabled_schema = 'disabled="disabled"';
                            }
                        ?>
                        <button class="btn btn-warning ms-1 requireConfirm" type="button" id="button_delete_schema"
                                data-route="index.php?route=/database/configuration&db=<?= $_GET["db"] ?>&delete=schema" <?= $disabled_schema ?>>
                            Löschen
                        </button>
                    </div>
                    <div class="text-end flex-grow-1">
                        <input type="hidden" name="action" value="schema"/>
                        <button class="btn btn-secondary ms-1" type="reset" id="button_reset_schema">Zurücksetzen
                        </button>
                        <button class="btn btn-primary ms-1" type="submit" id="button_submit_schema">OK</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="delete_file" title="Fortfahren" class="hide">
    <p>Wirklich löschen?</p>
</div>