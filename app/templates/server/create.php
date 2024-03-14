<?php

use CSVDB\Helpers\CSVConfig;
use CSVDB\Enums\DatatypeEnum;

$config = CSVConfig::default();
?>

<form name="config" method="post">
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
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
                <button type="button" class="btn btn-secondary">Go</button>
            </div>
        </div>
    </div>

    <div class="table-responsive-lg">
        <table class="table table-light table-striped align-middle my-3">
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
    </div>

    <!-- CONFIG FORM -->
    <div class="w-auto">
    <fieldset>
    <legend>Konfiguration</legend>

        <div class="mb-3">
            <label for="encoding" class="form-label">Encoding</label>
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
        </div>
        
        <div class="mb-3">
            <label for="delimiter" class="form-label">Delimiter</label>
            <input type="text" maxlength="1" name="delimiter" value="<?= $config->delimiter ?>" class="form-control"/>            
        </div>

        <div class="mb-3 form-check">
            <?php
                $cache_true = $config->cache ? 'checked="checked"' : '';
            ?>
            <input type="checkbox" class="form-check-input" id="cache" <?= $cache_true ?>>
            <label class="form-check-label" for="cache">Cache</label>
        </div>
        
        <div class="mb-3 form-check">
            <?php
                $history_true = $config->history ? 'checked="checked"' : '';
            ?>
            <input type="checkbox" class="form-check-input" id="history" <?= $history_true ?>>
            <label class="form-check-label" for="history">History</label>
        </div>
            </fieldset>
    </div>

    <div class="card-footer">
        <input class="btn btn-primary" type="submit" name="submit" value="Speichern">
    </div>
</div>
</form>