<?php

use CSVDB\Helpers\CSVConfig;
use CSVDB\Enums\DatatypeEnum;

$config = CSVConfig::default();
?>
<div class="row g-3 align-items-center pb-3">
  <div class="col-auto">
    <label for="database_name" class="col-form-label">Datenbank Name</label>
  </div>
  <div class="col-auto">
    <input type="text" id="database_name" class="form-control" aria-describedby="database_name">
  </div>

  <div class="col-auto">
    <label for="add_columns" class="col-form-label">Add</label>
  </div>
  <div class="col-auto">
    <input type="number" id="add_columns" class="form-control" aria-describedby="add_columns">
  </div>
  <div class="col-auto">
    column(s)
  </div>

  <div class="col-auto">
    <button type="button" class="btn btn-light">Go</button>
  </div>
</div>

<table class="table table-light table-striped align-middle my-3 insertRowTable w-auto">
    <thead>
        <tr>
            <th>Name</th>
            <th>Typ (?)</th>
            <th>Standardwert</th>
            <th>NULL</th>
            <th>Index</th>
            <th><abbr title="Auto Increment">AI</abbr></th>
            <th>Kommentar</th>
        </tr>
    </thead>
    <tbody>
        <tr class="noclick">
            <td class="text-center">
                <input type="text" name="name" class="form-control"/>
            </td>
            <td class="text-center">
                <select id="encoding" name="type" class="form-select">
                    <option></option>
                    <?php
                        foreach (DatatypeEnum::getConstants() as $type) {
                            $selected = "";
                            /*if (strtolower($encoding) == strtolower($config->encoding)) {
                                $selected = 'selected="selected"';
                            }*/
                            echo '<option value="' . $type . '" ' . $selected . '>' . $type . '</option>';
                        }
                    ?>
                </select>                
            </td>
            <td class="text-center">
                <input type="text" name="default" class="form-control"/>
            </td>
            <td class="text-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" name="null_value" id="null_value">
                </div>
            </td>
            <td class="text-center">
                <select id="encoding" name="index" class="form-select">
                    <option></option>
                    <option value="PRIMARY_KEY">PRIMARY KEY</option>
                    <option value="UNIQUE">UNIQUE</option>
                </select>
            </td>
            <td class="text-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="true" name="auto_increment" id="auto_increment">
                </div>
            </td>
            <td class="text-center">
                <input type="text" name="comment" class="form-control"/>
            </td>
        </tr>
    </tbody>
</table>

<!-- config -->
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
                                encoding
                            </td>
                            <td class="text-center text-nowrap">
                                <span class="column_type fst-italic" dir="ltr"><?= $default->encoding ?></span>
                            </td>
                            <td>
                                <select id="encoding" name="encoding" class="form-select">
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
                                <input type="text" maxlength="1" name="delimiter" value="<?= $config->delimiter ?>" class="form-control"/>
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

<div class="card-footer">
    <input class="btn btn-primary" type="submit" name="submit" value="Speichern">
</div>