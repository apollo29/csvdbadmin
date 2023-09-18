<h2>In den aktuell ausgewählten Server importieren</h2>

<div class="importoptions">
    <h3>Zu importierende Datei:</h3>

    <div class="formelementrow" id="compression_info">
        <p>
            Datei muss unkomprimiert sein. Es sind nur <strong>CSV-Dateien</strong> erlaubt.<br />
            Die CSV-Datei wird Zeilenweise gelesen und in die Datenbank importiert. Fehlende Felder werden leer gelassen.
        </p>
    </div>

    <div class="formelementrow" id="upload_form">
        <label for="input_import_file">Durchsuchen Sie Ihren Computer:</label>
        <input type="file" accept=".csv" name="import_file" id="input_import_file">(Maximal: 40MiB)
        <input type="hidden" name="MAX_FILE_SIZE" value="41943040">
    </div>

    <div class="formelementrow">
        <label for="charset_of_file">Zeichencodierung der Datei:</label>
        <select id="charset_of_file" name="charset_of_file" size="1">
            <option value="iso-8859-1">
                iso-8859-1
            </option>
            <option value="iso-8859-2">
                iso-8859-2
            </option>
            <option value="iso-8859-3">
                iso-8859-3
            </option>
            <option value="iso-8859-4">
                iso-8859-4
            </option>
            <option value="iso-8859-5">
                iso-8859-5
            </option>
            <option value="iso-8859-6">
                iso-8859-6
            </option>
            <option value="iso-8859-7">
                iso-8859-7
            </option>
            <option value="iso-8859-8">
                iso-8859-8
            </option>
            <option value="iso-8859-9">
                iso-8859-9
            </option>
            <option value="iso-8859-10">
                iso-8859-10
            </option>
            <option value="iso-8859-11">
                iso-8859-11
            </option>
            <option value="iso-8859-12">
                iso-8859-12
            </option>
            <option value="iso-8859-13">
                iso-8859-13
            </option>
            <option value="iso-8859-14">
                iso-8859-14
            </option>
            <option value="iso-8859-15">
                iso-8859-15
            </option>
            <option value="windows-1250">
                windows-1250
            </option>
            <option value="windows-1251">
                windows-1251
            </option>
            <option value="windows-1252">
                windows-1252
            </option>
            <option value="windows-1256">
                windows-1256
            </option>
            <option value="windows-1257">
                windows-1257
            </option>
            <option value="koi8-r">
                koi8-r
            </option>
            <option value="big5">
                big5
            </option>
            <option value="gb2312">
                gb2312
            </option>
            <option value="utf-16">
                utf-16
            </option>
            <option value="utf-8" selected="selected">
                utf-8
            </option>
            <option value="utf-7">
                utf-7
            </option>
            <option value="x-user-defined">
                x-user-defined
            </option>
            <option value="euc-jp">
                euc-jp
            </option>
            <option value="ks_c_5601-1987">
                ks_c_5601-1987
            </option>
            <option value="tis-620">
                tis-620
            </option>
            <option value="SHIFT_JIS">
                SHIFT_JIS
            </option>
            <option value="SJIS">
                SJIS
            </option>
            <option value="SJIS-win">
                SJIS-win
            </option>
        </select>
    </div>
</div>
<div class="importoptions">
    <h3>Datenbanken:</h3>
    <div>
        <select name="db_select" id="db_select" size="5">
            <?php
            $databases = $admin->databases();
            foreach ($databases as $database => $csvdb) {
                echo '<option value="'.$database.'">'."\n";
                echo $database."\n";
                echo '</option>'."\n";
            }
            ?>
        </select>
    </div>
</div>
<div>
    <button class="btn btn-primary ms-1" type="submit" id="button_submit_import">OK</button>
</div>