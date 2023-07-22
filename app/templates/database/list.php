<?php
$data = $admin->database($_GET['db']);

$rows = $data->csvdb()->limit(25)->get();
$count = $data->csvdb()->count()->get();
?>
<div class="result_query">
    <div class="alert alert-success" role="alert">
        <img src="themes/dot.gif" title="" alt="" class="icon ic_s_success"> Zeige Datensätze 0 - 24
        (<?= $count['count'] ?> insgesamt)
    </div>

    <div class="sqlOuter">
        <code class="sql">
            <div class="sql-highlight cm-s-default">
                <span class="cm-keyword">SELECT</span>
                <span class="cm-operator">*</span>
                <span class="cm-keyword">FROM</span>
                <span class="cm-variable-2">game_set</span>
                <span class="cm-keyword">WHERE</span>
                <span class="cm-variable-2">name</span>
                <span class="cm-keyword">LIKE</span>
                <span class="cm-string">'%test%'</span>
            </div>
        </code>
    </div>
    <div class="tools">
        [&nbsp;<a href="#" class="inline_edit_sql">Inline bearbeiten</a>&nbsp;]
        [&nbsp;<a href="index.php"
                  data-post="route=/table/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60&amp;show_query=1">Bearbeiten</a>&nbsp;]
        [&nbsp;<a href="index.php"
                  data-post="route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60&amp;show_query=1&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60&amp;show_query=1">Aktualisieren</a>&nbsp;]
    </div>
</div>
<!-- DATABASE NAVIGATION -->
<table class="navigation d-print-none">
    <tbody><tr>
        <td class="navigation_separator"></td>


        <td>
            <form action="index.php?route=/sql" method="post">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC"><input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC"><input type="hidden" name="is_browse_distinct" value=""><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <select class="pageselector ajax" name="pos">                <option selected="selected" style="font-weight: bold" value="0">1</option>
                    <option value="25">2</option>
                </select>
            </form>
        </td>

        <td>
            <form action="index.php?route=/sql" method="post">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC">
                <input type="hidden" name="pos" value="25">
                <input type="hidden" name="is_browse_distinct" value="">
                <input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC">

                <input type="submit" name="navig" class="btn btn-secondary ajax" value="&nbsp;>" title="Nächste">
            </form>
        </td>
        <td>
            <form action="index.php?route=/sql" method="post" onsubmit="">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC">
                <input type="hidden" name="pos" value="25">
                <input type="hidden" name="is_browse_distinct" value="">
                <input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC">

                <input type="submit" name="navig" class="btn btn-secondary ajax" value="&nbsp;>>" title="Ende">
            </form>
        </td>


        <td><div class="navigation_separator">|</div></td>

        <td>
            <form action="index.php?route=/sql" method="post">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="server" value="1"><input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC"><input type="hidden" name="is_browse_distinct" value=""><input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC"><input type="hidden" name="session_max_rows" value="all"><input type="hidden" name="pos" value="0"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <input type="checkbox" name="navig" id="showAll_1238634197" class="showAllRows" value="all">
                <label for="showAll_1238634197">Alles anzeigen</label>
            </form>
        </td>
        <td><div class="navigation_separator">|</div></td>

        <td>
            <div class="save_edited hide">
                <input class="btn btn-link" type="submit" value="Speichere bearbeitete Daten">
                <div class="navigation_separator">|</div>
            </div>
        </td>
        <td>
            <div class="restore_column hide" style="display: none;">
                <input class="btn btn-link" type="submit" value="Spalten-Anordnung wiederherstellen">
                <div class="navigation_separator">|</div>
            </div>
        </td>
        <td class="navigation_goto">
            <form action="index.php?route=/sql" method="post" class="maxRowsForm">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="server" value="1"><input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC"><input type="hidden" name="is_browse_distinct" value=""><input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC"><input type="hidden" name="pos" value="0"><input type="hidden" name="unlim_num_rows" value="34"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">

                <label for="sessionMaxRowsSelect">Anzahl der Datensätze:</label>
                <select class="autosubmit" name="session_max_rows" id="sessionMaxRowsSelect">
                    <option value="25" selected="">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                </select>
            </form>
        </td>
        <td class="navigation_separator"></td>
        <td class="largescreenonly">
            <span>Zeilen filtern:</span>
            <input type="text" class="filter_rows" placeholder="Diese Tabelle durchsuchen" data-for="1238634197">
        </td>
        <td class="largescreenonly">
            <form action="index.php?route=/sql" method="post" class="d-print-none">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="server" value="1"><input type="hidden" name="sort_by_key" value="1"><input type="hidden" name="session_max_rows" value="25"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                Nach Schlüssel sortieren:              <select name="sql_query" class="autosubmit">
                    <option value="SELECT * FROM `game_set`   ORDER BY `uid` ASC">PRIMARY (ASC)</option>
                    <option value="SELECT * FROM `game_set`   ORDER BY `uid` DESC">PRIMARY (DESC)</option>
                    <option value="SELECT * FROM `game_set`   ORDER BY `product_id` ASC">product_id (ASC)</option>
                    <option value="SELECT * FROM `game_set`   ORDER BY `product_id` DESC">product_id (DESC)</option>
                    <option value="SELECT * FROM `game_set`  " selected="">keine</option>
                </select>
            </form>
        </td>
        <td class="navigation_separator"></td>
    </tr>
    </tbody></table>

<!-- DATABASE -->
<div class="table-responsive-md">
    <table class="table table-light table-striped table-hover table-sm table_results ajax w-auto pma_table">
        <thead class="table-light">
        <tr>
            <th class="column_action position-sticky d-print-none" colspan="4">
                <span><a href="index.php"
                         data-post="route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60&amp;goto=&amp;full_text_button=1&amp;pftext=F"><img
                                class="fulltext" src="./themes/img/s_fulltext.png" alt="Vollständige Texte"
                                title="Vollständige Texte"></a></span>
            </th>
            <?php
            $headers = $data->csvdb()->headers();
            foreach ($headers as $header) {
                echo '<th class="text column_heading marker pointer" data-column="'.$header.'">' . "\n";
                echo '<span><a href="#" class="sortlink">' . $header . '</a></span>' . "\n";
                echo '</th>' . "\n";
            }
            ?>
            <td class="d-print-none" colspan="4"><span></span></td>
        </tr>
        </thead>

        <tbody>
        <?php
        foreach ($rows as $item) { ?>
            <tr>
                <td class="text-center d-print-none"><span>
      <input type="checkbox" class="multi_checkbox checkall" id="id_rows_to_delete0_left" name="rows_to_delete[0]"
             value="`game_set`.`uid` = 1">
      <input type="hidden" class="condition_array" value="{&quot;`game_set`.`uid`&quot;:&quot;= 1&quot;}">
    </span></td>

                <td class="text-center d-print-none edit_row_anchor">
      <span class="text-nowrap">
        <a href="index.php"
           data-post="route=/table/change&amp;db=annodomini&amp;table=game_set&amp;where_clause=%60game_set%60.%60uid%60+%3D+1&amp;clause_is_unique=1&amp;sql_query=SELECT+%2A+FROM+%60game_set%60&amp;goto=index.php%3Froute%3D%2Fsql&amp;default_action=update"><span
                    class="text-nowrap"><img src="themes/dot.gif" title="Bearbeiten" alt="Bearbeiten"
                                             class="icon ic_b_edit">&nbsp;Bearbeiten</span></a>
                  <input type="hidden" class="where_clause" value="`game_set`.`uid` = 1">
              </span>
                </td>

                <td class="text-center d-print-none">
      <span class="text-nowrap">
        <a href="index.php"
           data-post="route=/table/change&amp;db=annodomini&amp;table=game_set&amp;where_clause=%60game_set%60.%60uid%60+%3D+1&amp;clause_is_unique=1&amp;sql_query=SELECT+%2A+FROM+%60game_set%60&amp;goto=index.php%3Froute%3D%2Fsql&amp;default_action=insert"><span
                    class="text-nowrap"><img src="themes/dot.gif" title="Kopieren" alt="Kopieren"
                                             class="icon ic_b_insrow">&nbsp;Kopieren</span></a>
                  <input type="hidden" class="where_clause" value="`game_set`.`uid` = 1">
              </span>
                </td>

                <td class="text-center d-print-none ajax">
      <span class="text-nowrap">
        <a href="index.php"
           data-post="route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=DELETE+FROM+%60game_set%60+WHERE+%60game_set%60.%60uid%60+%3D+1&amp;message_to_show=Der+Datensatz+wurde+gel%C3%B6scht.&amp;goto=index.php%3Froute%3D%2Fsql%26db%3Dannodomini%26table%3Dgame_set%26sql_query%3DSELECT%2B%252A%2BFROM%2B%2560game_set%2560%26message_to_show%3DDer%2BDatensatz%2Bwurde%2Bgel%25C3%25B6scht.%26goto%3Dindex.php%253Froute%253D%252Ftable%252Fsql"
           class="delete_row requireConfirm ajax"><span class="text-nowrap"><img src="themes/dot.gif" title="Löschen"
                                                                                 alt="Löschen" class="icon ic_b_drop">&nbsp;Löschen</span></a>
                  <div class="hide">DELETE FROM game_set WHERE `game_set`.`uid` = 1</div>
              </span>
                </td>
                <?php
                foreach ($item as $field) {
                    echo '<td class="text data grid_edit click2 not_null text-nowrap"><span>' . $field . '</span></td>' . "\n";
                }
                ?>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- ACTIONS -->
<div class="d-print-none">
    <img class="selectallarrow" src="./themes/img/arrow_ltr.png" width="38" height="22" alt="markierte:">
    <input type="checkbox" id="resultsForm_1238634197_checkall" class="checkall_box" title="Alle auswählen">
    <label for="resultsForm_1238634197_checkall">Alle auswählen</label>
    <em class="with-selected">markierte:</em>

    <button class="btn btn-link mult_submit" type="submit" name="submit_mult" value="edit" title="Bearbeiten">
        <span class="text-nowrap"><img src="themes/dot.gif" title="Bearbeiten" alt="Bearbeiten" class="icon ic_b_edit">&nbsp;Bearbeiten</span>
    </button>

    <button class="btn btn-link mult_submit" type="submit" name="submit_mult" value="copy" title="Kopieren">
        <span class="text-nowrap"><img src="themes/dot.gif" title="Kopieren" alt="Kopieren" class="icon ic_b_insrow">&nbsp;Kopieren</span>
    </button>

    <button class="btn btn-link mult_submit" type="submit" name="submit_mult" value="delete" title="Löschen">
        <span class="text-nowrap"><img src="themes/dot.gif" title="Löschen" alt="Löschen" class="icon ic_b_drop">&nbsp;Löschen</span>
    </button>

    <button class="btn btn-link mult_submit" type="submit" name="submit_mult" value="export" title="Exportieren">
        <span class="text-nowrap"><img src="themes/dot.gif" title="Exportieren" alt="Exportieren"
                                       class="icon ic_b_tblexport">&nbsp;Exportieren</span>
    </button>
</div>

<!-- DATABASE NAVIGATION -->
<table class="navigation d-print-none">
    <tbody><tr>
        <td class="navigation_separator"></td>


        <td>
            <form action="index.php?route=/sql" method="post">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC"><input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC"><input type="hidden" name="is_browse_distinct" value=""><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <select class="pageselector ajax" name="pos">                <option selected="selected" style="font-weight: bold" value="0">1</option>
                    <option value="25">2</option>
                </select>
            </form>
        </td>

        <td>
            <form action="index.php?route=/sql" method="post">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC">
                <input type="hidden" name="pos" value="25">
                <input type="hidden" name="is_browse_distinct" value="">
                <input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC">

                <input type="submit" name="navig" class="btn btn-secondary ajax" value="&nbsp;>" title="Nächste">
            </form>
        </td>
        <td>
            <form action="index.php?route=/sql" method="post" onsubmit="">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC">
                <input type="hidden" name="pos" value="25">
                <input type="hidden" name="is_browse_distinct" value="">
                <input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC">

                <input type="submit" name="navig" class="btn btn-secondary ajax" value="&nbsp;>>" title="Ende">
            </form>
        </td>


        <td><div class="navigation_separator">|</div></td>

        <td>
            <form action="index.php?route=/sql" method="post">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="server" value="1"><input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC"><input type="hidden" name="is_browse_distinct" value=""><input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC"><input type="hidden" name="session_max_rows" value="all"><input type="hidden" name="pos" value="0"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                <input type="checkbox" name="navig" id="showAll_1238634197" class="showAllRows" value="all">
                <label for="showAll_1238634197">Alles anzeigen</label>
            </form>
        </td>
        <td><div class="navigation_separator">|</div></td>

        <td>
            <div class="save_edited hide">
                <input class="btn btn-link" type="submit" value="Speichere bearbeitete Daten">
                <div class="navigation_separator">|</div>
            </div>
        </td>
        <td>
            <div class="restore_column hide" style="display: none;">
                <input class="btn btn-link" type="submit" value="Spalten-Anordnung wiederherstellen">
                <div class="navigation_separator">|</div>
            </div>
        </td>
        <td class="navigation_goto">
            <form action="index.php?route=/sql" method="post" class="maxRowsForm">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="server" value="1"><input type="hidden" name="sql_query" value="SELECT * FROM `game_set`
ORDER BY `game_set`.`name` ASC"><input type="hidden" name="is_browse_distinct" value=""><input type="hidden" name="goto" value="index.php?route=/sql&amp;db=annodomini&amp;table=game_set&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC"><input type="hidden" name="pos" value="0"><input type="hidden" name="unlim_num_rows" value="34"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">

                <label for="sessionMaxRowsSelect">Anzahl der Datensätze:</label>
                <select class="autosubmit" name="session_max_rows" id="sessionMaxRowsSelect">
                    <option value="25" selected="">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                </select>
            </form>
        </td>
        <td class="navigation_separator"></td>
        <td class="largescreenonly">
            <span>Zeilen filtern:</span>
            <input type="text" class="filter_rows" placeholder="Diese Tabelle durchsuchen" data-for="1238634197">
        </td>
        <td class="largescreenonly">
            <form action="index.php?route=/sql" method="post" class="d-print-none">
                <input type="hidden" name="db" value="annodomini"><input type="hidden" name="table" value="game_set"><input type="hidden" name="server" value="1"><input type="hidden" name="sort_by_key" value="1"><input type="hidden" name="session_max_rows" value="25"><input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                Nach Schlüssel sortieren:              <select name="sql_query" class="autosubmit">
                    <option value="SELECT * FROM `game_set`   ORDER BY `uid` ASC">PRIMARY (ASC)</option>
                    <option value="SELECT * FROM `game_set`   ORDER BY `uid` DESC">PRIMARY (DESC)</option>
                    <option value="SELECT * FROM `game_set`   ORDER BY `product_id` ASC">product_id (ASC)</option>
                    <option value="SELECT * FROM `game_set`   ORDER BY `product_id` DESC">product_id (DESC)</option>
                    <option value="SELECT * FROM `game_set`  " selected="">keine</option>
                </select>
            </form>
        </td>
        <td class="navigation_separator"></td>
    </tr>
    </tbody></table>

<!-- FIELDSET -->
<fieldset class="pma-fieldset d-print-none">
    <legend>Operationen für das Abfrageergebnis</legend>

    <button type="button" class="btn btn-link jsPrintButton"><span class="text-nowrap"><img src="themes/dot.gif"
                                                                                            title="Drucken"
                                                                                            alt="Drucken"
                                                                                            class="icon ic_b_print">&nbsp;Drucken</span>
    </button>

    <a href="#" id="copyToClipBoard" class="btn"><span class="text-nowrap"><img src="themes/dot.gif"
                                                                                title="In Zwischenablage kopieren"
                                                                                alt="In Zwischenablage kopieren"
                                                                                class="icon ic_b_insrow">&nbsp;In Zwischenablage kopieren</span></a>

    <a href="index.php"
       data-post="route=/table/export&amp;db=annodomini&amp;table=game_set&amp;printview=1&amp;sql_query=SELECT+%2A+FROM+%60game_set%60++%0AORDER+BY+%60game_set%60.%60name%60+ASC&amp;single_table=true&amp;unlim_num_rows=34"
       class="btn"><span class="text-nowrap"><img src="themes/dot.gif" title="Exportieren" alt="Exportieren"
                                                  class="icon ic_b_tblexport">&nbsp;Exportieren</span></a>
</fieldset>