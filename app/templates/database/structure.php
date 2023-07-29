<?php

use CSVDB\Enums\ConstraintEnum;

$data = $admin->database($_GET['db']);
$schema = $data->csvdb()->getSchema();

if (!empty($_GET["delete_constraint"])) {
    var_dump($_GET);
    // todo this is change in the schema!
}
if (!empty($_GET["rename_field"])) {
    var_dump($_GET);
    // todo this is change in the schema!
}
?>
<script src="script/database/structure.js"></script>
<div class="table-responsive-md">
    <table id="tablestructure" class="table table-light table-striped table-hover w-auto align-middle">
        <thead>
        <tr>
            <th class="d-print-none"></th>
            <th>#</th>
            <th>Name</th>
            <th>Typ</th>
            <th>Encoding</th>
            <th>Null</th>
            <th>Standard</th>
            <th>Kommentare</th>
            <th>Extra</th>
            <th colspan="2" class="action d-print-none">Aktion</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach ($schema as $field => $structure) {
            ?>
            <tr>
                <td class="text-center d-print-none">
                    <input type="checkbox" class="checkall" name="selected_fld[]" value="<?= $field ?>"
                           id="checkbox_row_<?= $i ?>">
                </td>
                <td class="text-end"><?= $i ?></td>
                <th class="text-nowrap">
                    <label for="checkbox_row_<?= $i ?>">
                        <?= $field ?>
                        <?php
                        if (array_key_exists("constraint", $structure)) {
                            if ($structure["constraint"] == ConstraintEnum::PRIMARY_KEY) {
                                echo '<img src="themes/dot.gif" title="Primärschlüssel" alt="Primärschlüssel"
                             class="icon ic_b_primary">';
                            } else if ($structure["constraint"] == ConstraintEnum::UNIQUE) {
                                echo '<img src="themes/dot.gif" title="Index" alt="Index"
                             class="icon ic_bd_primary">';
                            }
                        }
                        ?>
                    </label>
                </th>
                <td class="text-nowrap">
                    <bdo dir="ltr" lang="en">
                        <?= $structure["type"] ?>
                    </bdo>
                </td>
                <td><?= $structure["encoding"] ?></td>
                <td>
                    <?php
                    if (array_key_exists("nullable", $structure) && $structure["nullable"]) {
                        echo "Ja";
                    } else {
                        echo "Nein";
                    }
                    ?>
                </td>
                <td class="text-nowrap">
                    <?php
                    if (array_key_exists("default", $structure) && !empty($structure["default"])) {
                        echo $structure["default"];
                    } else {
                        echo "<em>kein(e)</em>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if (array_key_exists("comment", $structure) && !empty($structure["comment"])) {
                        echo $structure["comment"];
                    }
                    ?>
                </td>
                <td class="text-nowrap"><?php
                    if (array_key_exists("extra", $structure) && !empty($structure["extra"])) {
                        echo $structure["extra"];
                    }
                    ?></td>

                <td class="edit text-center d-print-none">
                    <a href="#" class="rename_field" data-field="<?= $field ?>">
                        <span class="text-nowrap"><img src="themes/dot.gif" title="Umbenennen" alt="Umbenennen"
                                                       class="icon ic_b_rename">&nbsp;Umbenennen</span>
                    </a>
                </td>

                <td class="d-print-none">
                    <div class="dropdown">
                        <button class="btn btn-link p-0 dropdown-toggle" type="button" id="moreActionsButton"
                                data-bs-toggle="dropdown" aria-expanded="false">Mehr
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreActionsButton">
                            <li class="add_primary primary text-nowrap">
                                <a rel="samepage"
                                   class="dropdown-item add_primary d-print-none add_unique_anchor <?= (array_key_exists("constraint", $structure) && $structure["constraint"] == "primary") ? "disabled" : "" ?>"
                                   href="index.php?route=/database/structure&db=<?= $_GET["db"] ?>&add-primary=<?= $field ?>">
                                    <span class="text-nowrap"><img src="themes/dot.gif" title="Primärschlüssel"
                                                                   alt="Primärschlüssel"
                                                                   class="icon ic_bd_primary">&nbsp;Primärschlüssel</span>
                                </a>
                            </li>

                            <li class="add_unique unique text-nowrap">
                                <a rel="samepage"
                                   class="dropdown-item add_unique d-print-none add_unique_anchor <?= (array_key_exists("constraint", $structure) && ($structure["constraint"] == "unique" || $structure["constraint"] == "primary")) ? "disabled" : "" ?>"
                                   href="index.php?route=/database/structure&db=<?= $_GET["db"] ?>&add-key=<?= $field ?>"
                                   data-post="db=annodomini&amp;table=game_set&amp;sql_query=ALTER+TABLE+%60game_set%60+ADD+UNIQUE%28%60uid%60%29%3B&amp;message_to_show=Ein+Index+wurde+in+uid+erzeugt.">
                                    <span class="text-nowrap"><img src="themes/dot.gif" title="Unique" alt="Unique"
                                                                   class="icon ic_b_unique">&nbsp;Unique</span>
                                </a>
                            </li>

                            <li class="add_nullable nullable text-nowrap">
                                <a rel="samepage" class="dropdown-item add_nullable d-print-none"
                                   href="index.php?route=/database/structure&db=<?= $_GET["db"] ?>&toggle-nullable=<?= $field ?>">
                                    <span class="text-nowrap"><img src="themes/dot.gif" title="Nullable" alt="Nullable"
                                                                   class="icon ic_b_help">&nbsp;Nullable</span>
                                </a>
                            </li>

                            <li class="add_default default text-nowrap">
                                <a rel="samepage" class="dropdown-item add_default d-print-none" href="#" data-field="<?= $field ?>" data-default="<?= (array_key_exists("default", $structure) && !empty($structure["default"])) ? $structure["default"] : "" ?>">
                                    <span class="text-nowrap"><img src="themes/dot.gif" title="Standard" alt="Standard"
                                                                   class="icon ic_b_comment">&nbsp;Standard</span>
                                </a>
                            </li>

                            <li class="add_comment comment text-nowrap">
                                <a rel="samepage" class="dropdown-item add_comment d-print-none" href="#" data-field="<?= $field ?>" data-comment="<?= (array_key_exists("comment", $structure) && !empty($structure["comment"])) ? $structure["comment"] : "" ?>">
                                    <span class="text-nowrap"><img src="themes/dot.gif" title="Comment" alt="Comment"
                                                                   class="icon ic_b_comment">&nbsp;Comment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
</div>

<form method="post" name="index">
    <div id="index_div" class="w-100">
        <fieldset class="pma-fieldset index_info">
            <legend id="index_header">
                Indizes
            </legend>

            <div class="table-responsive">
                <table class="table table-sm table-light table-striped table-hover w-auto align-middle"
                       id="table_index">
                    <thead class="table-light">
                    <tr>
                        <th class="d-print-none">Aktion</th>
                        <th>Schlüssel</th>
                        <th>Spalte</th>
                        <th>Null</th>
                        <th>Kommentar</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $constraints = $data->csvdb()->constraints();
                    foreach ($constraints as $key => $constraint) {
                        ?>

                        <tr class="noclick">
                            <td class="d-print-none">
                                <a href="#"
                                   data-route="index.php?route=/database/structure&db=<?= $_GET["db"] ?>&delete_constraint=<?= $key ?>"
                                   class="requireConfirm <?= ($constraint["constraint"] == "primary") ? "disabled" : "" ?>">
                                    <span class="text-nowrap">
                                        <img src="themes/dot.gif" title="Löschen" alt="Löschen" class="icon ic_b_drop">&nbsp;Löschen
                                    </span>
                                </a>
                            </td>
                            <td><strong><?= $constraint["constraint"] ?></strong></td>
                            <td><?= $key ?></td>
                            <td><?= (array_key_exists("nullable", $schema[$key]) && $schema[$key]["nullable"]) ? "Ja" : "Nein" ?></td>
                            <td><?= (array_key_exists("comment", $schema[$key])) ? $schema[$key]["comment"] : "" ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</form>

<div id="delete_index" title="Fortfahren" class="hide">
    <p>Möchten Sie diesen Index wirklich löschen?</p>
</div>

<div class="modal" tabindex="-1" id="rename_field">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Feld umbenennen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schliessen"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="pma-fieldset" id="index_edit_fields">
                        <div class="index_info">
                            <div>
                                <div class="label">
                                    <strong>
                                        <label for="input_name">Feldname:</label>
                                    </strong>
                                </div>
                                <input type="text" name="rename_field_value" id="rename_field_value" class="w-100"/>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="route" value="/database/structure">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="rename_field" id="rename_field_name">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="add_comment">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Kommentar hinzufügen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schliessen"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="pma-fieldset" id="index_edit_fields">
                        <div class="index_info">
                            <div>
                                <div class="label">
                                    <strong>
                                        <label for="input_name">Kommentar:</label>
                                    </strong>
                                </div>
                                <input type="text" name="comment" id="comment_value" class="w-100"/>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="route" value="/database/structure">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="comment_field" id="comment_field_name">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="default_value">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title">Standard-Wert hinzufügen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schliessen"></button>
                </div>
                <div class="modal-body">
                    <fieldset class="pma-fieldset" id="index_edit_fields">
                        <div class="index_info">
                            <div>
                                <div class="label">
                                    <strong>
                                        <label for="input_name">Standard-Wert:</label>
                                    </strong>
                                </div>
                                <input type="text" name="default" id="default_value" class="w-100"/>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="route" value="/database/structure">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="default_field" id="default_field_name">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>