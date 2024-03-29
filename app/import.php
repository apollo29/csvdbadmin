<?php

use CSVDB\Enums\ExportEnum;
use CSVDBAdmin\CSVDBAdmin;

require '../vendor/autoload.php';

$admin = new CSVDBAdmin(__DIR__);
$route = $admin->get_route($_POST, "/server/export");
$db = $admin->get_database($_POST);
if (array_key_exists("db_select", $_POST) && !is_array($_POST['db_select'])) {
    $db = $_POST['db_select'];
}

$db_param = "";
if (!empty($db)) {
    $db_param = "&db=" . $db;
}

try {
    if ($_POST) {
        if (array_key_exists("db_select", $_POST) && array_key_exists("format", $_POST)) {
            $sql_query = null;
            if (array_key_exists("sql_query", $_POST)) {
                $sql_query = $_POST["sql_query"];
            }
            $records = $admin->export($_POST['db_select'], $_POST['format'], $sql_query);

            $filename = "export";
            if (array_key_exists("filename", $_POST)) {
                $filename = $_POST["filename"];
            } else if (!empty($db)) {
                $filename = $db;
            }

            $extension = ".csv";
            switch ($_POST['format']) {
                case ExportEnum::JSON:
                    $extension = ".json";
                    break;
                case ExportEnum::SQL:
                    $extension = ".sql";
                    break;
                case ExportEnum::PHP:
                    $extension = ".php";
                    break;
            }

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $filename . $extension);
            header('Content-Length: ' . strlen($records));
            header('Connection: close');
            echo $records;
        } else {
            header("Location: index.php?route=" . $route . $db_param . "&error=export");
        }
        exit;
    } else {
        header("Location: index.php?route=" . $route . $db_param . "&error=post");
        exit;
    }
} catch (Exception $e) {
    header("Location: index.php?route=" . $route . $db_param . "&error=exception");
    exit;
}