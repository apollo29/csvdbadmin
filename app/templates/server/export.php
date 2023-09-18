<h2>Datenbanken des aktuell ausgewählten Servers exportieren</h2>

<form method="post" name="export" action="export.php">
    <div class="exportoptions">
        <h3>Datenbanken:</h3>
        <div>
            <p>
                <a href="#" onclick="Functions.setSelectOptions('dump', 'db_select[]', true); return false;">Alle
                    auswählen</a> /
                <a href="#" onclick="Functions.setSelectOptions('dump', 'db_select[]', false); return false;">Auswahl
                    entfernen</a>
            </p>

            <select name="db_select[]" id="db_select" size="5" multiple="">
                <?php
                $databases = $admin->databases();
                foreach ($databases as $database => $csvdb) {
                    echo '<option value="' . $database . '">' . "\n";
                    echo $database . "\n";
                    echo '</option>' . "\n";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="exportoptions">
        <h3>Format:</h3>
        <select id="format" name="format">
            <option selected="selected" value="csv">CSV</option>
            <option value="json">JSON</option>
            <option value="php">PHP array</option>
            <option value="sql">SQL</option>
        </select>
    </div>
    <div>
        <button class="btn btn-primary ms-1" type="submit" id="button_submit_export">OK</button>
    </div>
</form>