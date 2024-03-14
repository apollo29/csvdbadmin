<?php

use League\Csv\InvalidArgument;

$db = $admin->get_database($_GET);
$data = $admin->database($db);

// todo sql syntax checker und highlighter --> ACE

$sql_query = "SELECT * FROM " . $_GET["db"];
if (!empty($_GET["sql_query"])) {
    $sql_query = $_GET["sql_query"];
}
?>
<script src="https://cdn.jsdelivr.net/npm/@rechat/squel@5.15.1/dist/squel.min.js"></script>
<script src="https://unpkg.com/node-sql-parser/umd/mysql.umd.js"></script>
<script src="script/database/sql.js"></script>
<script>
$(document).ready(function () {
    var query = "<?= $sql_query ?>";
    
    const parser = new NodeSQLParser.Parser();
    const ast = parser.astify(query);
    console.log(ast);
    const sql = parser.sqlify(ast);
    console.log(sql);

    $("#parse_sql_query").val(sql);

    
    console.log(ast.columns.length);
    console.log(ast.columns[0].expr.column);

    $("#columns").on('change', function() {
        console.log($(this).val());

        var test=[];
        $(this).val().forEach((element) => {
            // has * only
            if (ast.columns.length===1 && ast.columns[0].expr.column) {
                $("#columns").each(function(){
                    test.push(
                        { "expr":{
                                "type":"column_ref",
                                "table":null,
                                "column":element
                            },
                            "as":null
                        });
                });
            }
        });      

        console.log(test);
        ast.columns = test;
        
        const sql = parser.sqlify(ast);
        console.log(sql);

        $("#parse_sql_query").val(sql);
    });

});
</script>

<form method="get" name="sqlQuery" id="sqlQuery">
    <input type="hidden" name="route" value="/database/sql">
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
        <div>
            <textarea name="parse_sql_query" id="parse_sql_query" class="form-control"></textarea>
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