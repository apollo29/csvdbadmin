<?php

use CSVDB\Enums\ExportEnum;
use CSVDBAdmin\CSVDBAdmin;

require '../vendor/autoload.php';

try {
    if ($_POST) {
        if (array_key_exists("db_select", $_POST) && array_key_exists("format", $_POST)) {
            /*
             * db_select
             * format
             * sql query!
             */

            $admin = new CSVDBAdmin(__DIR__);
            $records = $admin->export($_POST['db_select'], $_POST['format']);

            $filename = ".csv";
            switch ($_POST['format']) {
                case ExportEnum::JSON:
                    $filename = ".json";
                    break;
                case ExportEnum::SQL:
                    $filename = ".sql";
                    break;
                case ExportEnum::PHP:
                    $filename = ".php";
                    break;
            }

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=export' . $filename);
            header('Content-Length: ' . strlen($records));
            header('Connection: close');
            echo $records;
        } else {
// todo
//            if (array_key_exists("route", $_POST)) {
//                header("Location: index.php?route=" . $_POST['route'] . "&error=export");
//                exit;
//            }
            header("Location: index.php?route=/server/export&error=export");
        }
        exit;
    } else {
        header("Location: index.php?route=/server/export&error=post");
        exit;
    }
} catch (Exception $e) {
    header("Location: index.php?route=/server/export&error=exception");
    exit;
}
?>

