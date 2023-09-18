<?php

use CSVDBAdmin\CSVDBAdmin;

require_once '../vendor/autoload.php';

$admin = new CSVDBAdmin(__DIR__);
$route = $admin->get_route($_GET);
$db = $admin->get_database($_GET);
?>
<html lang="en">
<head>
    <title>CSVDBAdmin</title>

    <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
            integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="themes/css/theme.css"/>
    <link rel="stylesheet" type="text/css" href="themes/jquery/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="themes/layout.css"/>

    <script src="https://cdn.jsdelivr.net/npm/ace-builds@1.23.4/src-min-noconflict/ace.min.js"></script>
    <script src="script/ace_mode-csvdb.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/ace-builds@1.23.4/css/ace.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.8.0/build/styles/github.min.css">
    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/highlight.min.js"></script>
    <script src="script/main.js"></script>
</head>

<body>

<div class="d-flex">

    <div id="pma_navigation" class="d-print-none">
        <div id="pma_navigation_content">
            <div id="pma_navigation_header">
                <div id="pmalogo">
                    <a href="index.php">
                        <img id="imgpmalogo" src="./themes/img/logo_left.png" alt="phpMyAdmin">
                    </a>

                    <div id="navipanellinks">
                        <a href="index.php?route=/" title="Startseite"><img src="themes/dot.gif" title="Startseite"
                                                                            alt="Startseite" class="icon ic_b_home"></a>

                        <a href="https://github.com/apollo29/csvdbadmin" title="CSVDBAdmin-Dokumentation"
                           target="_blank"
                           rel="noopener noreferrer"><img src="themes/dot.gif" title="CSVDBAdmin-Dokumentation"
                                                          alt="CSVDBAdmin-Dokumentation" class="icon ic_b_docs"></a>

                        <a id="pma_navigation_reload" href="#" title="Navigations-Panel aktualisieren"><img
                                    src="themes/dot.gif"
                                    title="Navigations-Panel aktualisieren"
                                    alt="Navigations-Panel aktualisieren"
                                    class="icon ic_s_reload"></a>
                    </div>
                </div>
            </div>

            <div id="pma_navigation_tree" class="list_container synced highlight autoexpand mt-5">
                <div id='pma_navigation_tree_content'>
                    <ul>
                        <li class="first new_database italics">
                            <div class="block">
                                <i class="first"></i>
                            </div>

                            <div class="block second">
                                <a href="index.php?route=/server/databases"><img src="themes/dot.gif" title="Neu"
                                                                                 alt="Neu"
                                                                                 class="icon ic_b_newdb"></a>
                            </div>

                            <a class="hover_show_full" href="index.php?route=/server/databases" title="Neu">Neu</a>

                            <div class="clearfloat"></div>
                        </li>
                        <?php
                        $databases = $admin->databases();
                        $i = 0;
                        $numItems = count($databases);
                        foreach ($databases as $database => $csvdb) {
                            $icon = "ic_s_db";
                            if (!$csvdb->hasConfig()) {
                                $icon = "ic_b_engine";
                            }
                            $last = (++$i === $numItems) ? "last" : "";
                            echo '<li class="' . $last . ' database">' . "\n";
                            echo '<div class="block">' . "\n" . '<i></i>' . "\n";
                            if (empty($last)) {
                                echo '<b></b>' . "\n";
                            }
                            echo '</div>' . "\n";
                            echo '<div class="block second"><a href="index.php?route=/database/structure&db=' . $database . '"><img
                                            src="themes/dot.gif"
                                            title="Datenbank-Konfiguration"
                                            alt="Datenbank-Konfiguration"
                                            class="icon ' . $icon . '"></a></div>' . "\n";
                            echo '<a class="hover_show_full" href="index.php?route=/database/list&db=' . $database . '" title="Struktur">' . $database . '</a>' . "\n";
                            echo '<div class="clearfloat"></div>' . "\n";
                            echo '</li>' . "\n";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="flex-grow-1">

        <div id="floating_menubar" class="d-print-none">

            <nav id="server-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-navbar">
                    <li class="breadcrumb-item">
                        <img src="themes/dot.gif" title="root" alt="root" class="icon ic_s_host">
                        <a href="index.php?route=/">
                            Server: <?= $_SERVER['SERVER_NAME'] ?>
                        </a>
                    </li>
                    <?php
                    if (isset($db)) {
                        echo '<li class="breadcrumb-item">
                                <img src="themes/dot.gif" title="" alt="" class="icon ic_s_db">
                                <a href="index.php?route=/database/list&db=' . $db . '">
                                    Datenbank: ' . $db . '
                                </a>
                             </li>';
                    }
                    ?>
                </ol>
            </nav>
            <div id="topmenucontainer" class="menucontainer">
                <?php
                switch ($route) {
                    case "/database/change":
                    case "/database/configuration":
                    case "/database/export":
                    case "/database/history":
                    case "/database/history/list":
                    case "/database/import":
                    case "/database/list":
                    case "/database/search":
                    case "/database/sql":
                    case "/database/structure":
                        $menubar_template = "templates/menubar/database.php";
                        break;
                    default:
                        $menubar_template = "templates/menubar/default.php";
                }
                include $menubar_template;
                ?>
            </div>
        </div>

        <div id="page_content">
            <div class="container-fluid my-3">
                <?php
                switch ($route) {
                    case "/database/change":
                    case "/database/configuration":
                    case "/database/export":
                    case "/database/history":
                    case "/database/import":
                    case "/database/list":
                    case "/database/search":
                    case "/database/sql":
                    case "/database/structure":
                    case "/server/export":
                    case "/server/import":
                    case "/server/sql":
                        $content_template = "templates" . $route . ".php";
                        break;
                    case "/database/history/list":
                        $content_template = "templates/database/history_list.php";
                        break;
                    default:
                        $content_template = "templates/main.php";
                }
                include $content_template;
                ?>
            </div>
        </div>

    </div>
</div>

</body>
</html>