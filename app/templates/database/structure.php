<?php

use CSVDB\Enums\ConstraintEnum;

$data = $admin->database($_GET['db']);
$schema = $data->csvdb()->getSchema();
?>
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
                <td class="text-nowrap"><?php
                    if (array_key_exists("extra", $structure) && !empty($structure["extra"])) {
                        echo $structure["extra"];
                    }
                    ?></td>

                <td class="edit text-center d-print-none">
                    <a class="change_column_anchor ajax"
                       href="index.php?route=/table/structure/change&amp;db=annodomini&amp;table=game_set&amp;field=uid&amp;change_column=1">
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
                            <li class="primary text-nowrap">
                                <span class="dropdown-item-text disabled"><span class="text-nowrap"><img
                                                src="themes/dot.gif" title="Primärschlüssel" alt="Primärschlüssel"
                                                class="icon ic_bd_primary">&nbsp;Primärschlüssel</span></span>
                            </li>

                            <li class="add_unique unique text-nowrap">
                                <a rel="samepage" class="dropdown-item ajax add_key d-print-none add_unique_anchor"
                                   href="index.php?route=/table/structure/add-key"
                                   data-post="db=annodomini&amp;table=game_set&amp;sql_query=ALTER+TABLE+%60game_set%60+ADD+UNIQUE%28%60uid%60%29%3B&amp;message_to_show=Ein+Index+wurde+in+uid+erzeugt.">
                                    <span class="text-nowrap"><img src="themes/dot.gif" title="Unique" alt="Unique"
                                                                   class="icon ic_b_unique">&nbsp;Unique</span>
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

