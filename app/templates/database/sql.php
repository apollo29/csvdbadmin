<?php

// todo sql syntax checker

$sql_query = "SELECT * FROM " . $_GET["db"];
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}
?>
<div class="card mb-3">
    <div class="card-header">
        SQL-Befehl(e) in Datenbank <a
                href="index.php?route=/database/list&amp;db=<?= $_GET["db"] ?>"><?= $_GET["db"] ?></a> ausführen:
    </div>
    <div class="card-body">
        <div id="queryfieldscontainer">
            <div class="mb-3">
                <textarea class="form-control" tabindex="100" name="sql_query" id="sqlquery" cols="20" rows="5"
                          aria-label="SQL-Befehl"><?= $sql_query ?></textarea>
            </div>
        </div>

    </div>
    <div class="card-footer">
        <input class="btn btn-primary ms-1" type="submit" id="button_submit_query" name="SQL" tabindex="200" value="OK">
    </div>
</div>

<div id="sqlqueryresultsouter">
    <div class="alert alert-danger" role="alert">
        <h3>Fehler</h3>
        <p><strong>SQL-Befehl:</strong></p>
        <pre><code class="language-sql"><?= $sql_query ?></code></pre>

        <p><strong>CSVDB meldet: </strong></p>
        <code>#1064 - Fehler in der SQL-Syntax. Bitte die korrekte Syntax im Handbuch nachschlagen bei '* FROM `account`
            WHERE 1 LIMIT 0, 25' in Zeile 1</code>
    </div>
</div>