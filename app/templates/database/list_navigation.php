<table class="navigation d-print-none">
    <tbody>
    <tr>
        <td class="navigation_separator"></td>
        <?php if ($pos > 0 && !$showAll) { ?>
            <td>
                <form action="index.php" method="get">
                    <input type="hidden" name="route" value="/database/list">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                    <input type="hidden" name="pos" value="0">
                    <input type="hidden" name="limit" value="<?= $limit ?>">
                    <button class="btn btn-secondary btn-pagination" title="Anfang"><<</button>
                </form>
            </td>
            <td>
                <form action="index.php" method="get">
                    <input type="hidden" name="route" value="/database/list">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                    <input type="hidden" name="pos" value="<?= ($pos - $limit) ?>">
                    <input type="hidden" name="limit" value="<?= $limit ?>">
                    <button class="btn btn-secondary btn-pagination" title="Vorherige"><</button>
                </form>
            </td>
        <?php } ?>

        <?php if (!$showAll) { ?>
            <td>
                <form action="index.php" method="get" name="pageselector">
                    <input type="hidden" name="route" value="/database/list">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                    <input type="hidden" name="limit" value="<?= $limit ?>">
                    <select class="pageselector" name="pos">
                        <?php
                        for ($i = 0; $i < ($count / $limit); $i++) {
                            $value = $i * $limit;
                            $selected = "";
                            if ($pos == $value) {
                                $selected = 'selected="selected"';
                            }
                            echo '<option value="' . $value . '" ' . $selected . '>' . ($i + 1) . '</option>';
                        }
                        ?>
                    </select>
                </form>
            </td>
        <?php } ?>

        <?php if ($maxrow < $count && !$showAll) { ?>
            <td>
                <form action="index.php" method="get">
                    <input type="hidden" name="route" value="/database/list">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                    <input type="hidden" name="pos" value="<?= ($pos + $limit) ?>">
                    <input type="hidden" name="limit" value="<?= $limit ?>">
                    <button class="btn btn-secondary btn-pagination" title="Nächste">></button>
                </form>
            </td>
            <td>
                <form action="index.php" method="get">
                    <input type="hidden" name="route" value="/database/list">
                    <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                    <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                    <input type="hidden" name="pos" value="25">
                    <input type="hidden" name="limit" value="<?= $limit ?>">
                    <button class="btn btn-secondary btn-pagination" title="Ende">>></button>
                </form>
            </td>
        <?php } ?>

        <?php if (!$showAll) { ?>
            <td>
                <div class="navigation_separator">|</div>
            </td>
        <?php } ?>

        <td>
            <form action="index.php" method="get" name="showAll">
                <input type="hidden" name="route" value="/database/list">
                <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                <input type="hidden" name="history"
                       value="<?= (array_key_exists("history", $_GET)) ? $_GET["history"] : "" ?>">
                <input type="checkbox" name="showAll" id="showAll" class="showAllRows" value="all" <?php if ($showAll) {
                    echo 'checked="checked"';
                } ?>>
                <label for="showAll">Alles anzeigen</label>
            </form>
        </td>
        <td>
            <div class="navigation_separator">|</div>
        </td>

        <td class="navigation_goto">
            <form action="index.php" method="get" class="maxRowsForm" name="limit">
                <input type="hidden" name="route" value="/database/list">
                <input type="hidden" name="db" value="<?= $_GET["db"] ?>">
                <input type="hidden" name="sql_query" value="<?= $sql_query ?>">
                <input type="hidden" name="pos" value="<?= $pos ?>">

                <label for="limit">Anzahl der Datensätze:</label>
                <select name="limit" id="limit">
                    <?php if ($showAll) { ?>
                    <option <?php if ($showAll) {
                        echo 'selected="selected"';
                    } ?>>Alle</option><?php } ?>
                    <option value="25" <?php if ($limit == 25) {
                        echo 'selected="selected"';
                    } ?>>25
                    </option>
                    <option value="50" <?php if ($limit == 50) {
                        echo 'selected="selected"';
                    } ?>>50
                    </option>
                    <option value="100" <?php if ($limit == 100) {
                        echo 'selected="selected"';
                    } ?>>100
                    </option>
                    <option value="250" <?php if ($limit == 250) {
                        echo 'selected="selected"';
                    } ?>>250
                    </option>
                    <option value="500" <?php if ($limit == 500) {
                        echo 'selected="selected"';
                    } ?>>500
                    </option>
                </select>
            </form>
        </td>
        <td class="navigation_separator"></td>
    </tr>
    </tbody>
</table>