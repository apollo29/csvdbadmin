<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);
var_dump($_GET["route"]);
$route = $_GET["route"];
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

    <link rel="stylesheet" type="text/css" href="themes/css/theme.css"/>
    <link rel="stylesheet" type="text/css" href="themes/jquery/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="layout.css"/>
</head>

<body>

<div class="d-flex">

    <div id="pma_navigation">
        <div id="pma_navigation_content">
            <div id="pma_navigation_header">
                <div id="pmalogo">
                    <a href="index.php">
                        <img id="imgpmalogo" src="./themes/img/logo_left.png" alt="phpMyAdmin">
                    </a>

                    <div id="navipanellinks">
                        <a href="index.php?route=/" title="Startseite"><img src="themes/dot.gif" title="Startseite"
                                                                            alt="Startseite" class="icon ic_b_home"></a>

                        <a href="#" title="CSVDBAdmin-Dokumentation" target="_blank"
                           rel="noopener noreferrer"><img src="themes/dot.gif" title="CSVDBAdmin-Dokumentation"
                                                          alt="CSVDBAdmin-Dokumentation" class="icon ic_b_docs"></a>

                        <a id="pma_navigation_settings_icon" href="#" title="Navigationspanel-Einstellungen"><img
                                    src="themes/dot.gif" title="Navigationspanel-Einstellungen"
                                    alt="Navigationspanel-Einstellungen" class="icon ic_s_cog"></a>

                        <a id="pma_navigation_reload" href="#" title="Navigations-Panel aktualisieren"><img
                                    src="themes/dot.gif"
                                    title="Navigations-Panel aktualisieren"
                                    alt="Navigations-Panel aktualisieren"
                                    class="icon ic_s_reload"></a>
                    </div>


                    <img src="themes/dot.gif" title="Laden…" alt="Laden…" style="visibility: hidden; display:none"
                         class="icon ic_ajax_clock_small throbber">
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


                        <li class="database">
                            <div class="block">
                                <i></i>
                                <b></b>
                            </div>

                            <div class="block second">
                                <a href="index.php?route=/database/operations&db=bewegtunte_cntnd"><img
                                            src="themes/dot.gif"
                                            title="Datenbank-Operationen"
                                            alt="Datenbank-Operationen"
                                            class="icon ic_s_db"></a>
                            </div>

                            <a class="hover_show_full" href="index.php?route=/database/structure&db=bewegtunte_cntnd"
                               title="Struktur">bewegtunte_cntnd</a>


                            <div class="clearfloat"></div>

                        </li>

                        <li class="navGroup">
                            <div class="block">
                                <i></i>
                                <b></b>
                                <a class="expander loaded container" href="#">
                                <span class="hide paths_nav" data-apath="cm9vdA=="
                                      data-vpath="cm9vdA==.YW5ub2RvbWluaQ==" data-pos="0"></span>
                                    <img src="themes/dot.gif" title="Auf-/Zuklappen" alt="Auf-/Zuklappen"
                                         class="icon ic_b_plus">
                                </a>
                            </div>
                            <div class="fst-italic">

                                <div class="block second">
                                    <u><img src="themes/dot.gif" title="Gruppen" alt="Gruppen" class="icon ic_b_group"></u>
                                </div>
                                &nbsp;annodomini


                            </div>

                            <div class="clearfloat"></div>

                            <div class="list_container" style="display: none;">
                                <ul>
                                    <li class="database database">
                                        <div class="block">
                                            <i></i>
                                            <b></b>
                                            <a class="expander" href="#">
                                            <span class="hide paths_nav" data-apath="cm9vdA==.YW5ub2RvbWluaQ=="
                                                  data-vpath="cm9vdA==.YW5ub2RvbWluaQ==." data-pos="0"></span>
                                                <img src="themes/dot.gif" title="Auf-/Zuklappen" alt="Auf-/Zuklappen"
                                                     class="icon ic_b_plus">
                                            </a>
                                        </div>

                                        <div class="block second">
                                            <a href="index.php?route=/database/operations&db=annodomini"><img
                                                        src="themes/dot.gif" title="Datenbank-Operationen"
                                                        alt="Datenbank-Operationen" class="icon ic_s_db"></a>
                                        </div>

                                        <a class="hover_show_full"
                                           href="index.php?route=/database/structure&db=annodomini"
                                           title="Struktur">annodomini</a>


                                        <div class="clearfloat"></div>


                                    </li>
                                    <li class="database last database">
                                        <div class="block">
                                            <i></i>

                                            <a class="expander" href="#">
                                            <span class="hide paths_nav" data-apath="cm9vdA==.YW5ub2RvbWluaV9kZXY="
                                                  data-vpath="cm9vdA==.YW5ub2RvbWluaQ==.ZGV2" data-pos="0"></span>
                                                <img src="themes/dot.gif" title="Auf-/Zuklappen" alt="Auf-/Zuklappen"
                                                     class="icon ic_b_plus">
                                            </a>
                                        </div>

                                        <div class="block second">
                                            <a href="index.php?route=/database/operations&db=annodomini_dev"><img
                                                        src="themes/dot.gif" title="Datenbank-Operationen"
                                                        alt="Datenbank-Operationen" class="icon ic_s_db"></a>
                                        </div>

                                        <a class="hover_show_full"
                                           href="index.php?route=/database/structure&db=annodomini_dev"
                                           title="Struktur">annodomini_dev</a>


                                        <div class="clearfloat"></div>


                                    </li>

                                </ul>
                            </div>

                        </li>
                        <li class="database">
                            <div class="block">
                                <i></i>
                                <b></b>
                            </div>

                            <div class="block second">
                                <a href="index.php?route=/database/operations&db=bewegtunte_cntnd"><img
                                            src="themes/dot.gif"
                                            title="Datenbank-Operationen"
                                            alt="Datenbank-Operationen"
                                            class="icon ic_b_engine"></a>
                            </div>

                            <a class="hover_show_full" href="index.php?route=/database/structure&db=bewegtunte_cntnd"
                               title="Struktur">bewegtunte_cntnd</a>


                            <div class="clearfloat"></div>


                        </li>
                        <li class="last database">
                            <div class="block">
                                <i></i>
                            </div>

                            <div class="block second">
                                <a href="index.php?route=/database/operations&amp;db=test"><img src="themes/dot.gif"
                                                                                                title="Datenbank-Operationen"
                                                                                                alt="Datenbank-Operationen"
                                                                                                class="icon ic_s_db"></a>
                            </div>

                            <a class="hover_show_full" href="index.php?route=/database/structure&amp;db=test"
                               title="Struktur">test</a>


                            <div class="clearfloat"></div>


                        </li>

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
                        <img src="themes/dot.gif" title="" alt="" class="icon ic_s_host">
                        <a href="index.php?route=/" data-raw-text="127.0.0.1" draggable="false">
                            Server: 127.0.0.1
                        </a>
                    </li>

                </ol>
            </nav>
            <div id="topmenucontainer" class="menucontainer">
                <?php
                switch ($route) {
                    case "/database/structure":
                        $menubar_template = "menubar/database.twig";
                        break;
                    default:
                        $menubar_template = "menubar/default.twig";
                }
                echo $twig->render($menubar_template);
                ?>
            </div>
        </div>

        <div id="page_content">
            <div class="container-fluid my-3">
                <?php
                switch ($route) {
                    case "/database/structure":
                        $content_template = "database.twig";
                        break;
                    default:
                        $content_template = "main.twig";
                }
                echo $twig->render($content_template);
                ?>
            </div>
        </div>

    </div>
</div>

</body>
</html>