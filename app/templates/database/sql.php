<?php

use League\Csv\InvalidArgument;

$db = $admin->get_database($_GET);
$data = $admin->database($db);

$sql_query = "SELECT * FROM " . $_GET["db"];
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}
?>
<script src="https://unpkg.com/node-sql-parser/umd/mysql.umd.js"></script>
<script>
$(document).ready(function () {
    const aceEditor = ace.edit("editor");
    aceEditor.session.setMode("ace/mode/csvdb");
    const textarea = $('textarea[name="sql_query"]');
    aceEditor.session.on("change", function () {
        textarea.val(aceEditor.session.getValue());
    });

    const query = "<?= $sql_query ?>";    
    const parser = new NodeSQLParser.Parser();
    const ast = parser.astify(query);

    $("#columns").on('change', function() {

        var cols=[];
        $(this).val().forEach((element) => {
            $("#columns").each(function(){
                cols.push(
                    { "expr":{
                            "type":"column_ref",
                            "table":null,
                            "column":element
                        },
                        "as":null
                    });
            });
        });      

        console.log(cols);
        ast.columns = cols;
        
        let sql = parser.sqlify(ast);
        
        // todo csvdb #10
        sql = sql.replaceAll('`', '');

        $("#sql_query").val(sql);
        aceEditor.setValue(sql);
    });

});
</script>

<form method="get" name="sqlQuery" id="sqlQuery">
    <input type="hidden" name="route" value="/database/list">
    <input type="hidden" name="db" value="<?= $db ?>">

    <div class="card mb-3">
        <div class="card-header">
            SQL-Befehl(e) in Datenbank <a
                    href="index.php?route=/database/list&amp;db=<?= $_GET["db"] ?>"><?= $_GET["db"] ?></a> ausführen:
        </div>
        <div class="d-flex">
            <div class="flex-grow-1">
                <div id="editor" class="sql-editor" style="height: 100%;"><?= $sql_query ?></div>
                <textarea class="hide" name="sql_query" id="sql_query"><?= $sql_query ?></textarea>
            </div>
            <div class="bg-secondary-subtle" style="width: 200px;">
                <?php
                    $headers = $data->csvdb()->headers();
                    echo '<select class="form-control" id="columns" size="'.count($headers).'" multiple>';
                    foreach($headers as $header) {
                        echo "<option>".$header."</option>";
                    }
                    echo "</select>";
                ?>
            </div>
        </div>
        <div class="card-footer">
            <input class="btn btn-primary ms-1" type="submit" id="button_submit_query" name="SQL" tabindex="200" value="OK">
        </div>
    </div>
</form>

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