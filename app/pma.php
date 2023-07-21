<?php

require_once '../vendor/autoload.php';

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
</head>

<body>

<div id="pma_navigation" class="d-print-none" data-config-navigation-width="240" style="width: 240px;">


    <div id="pma_navigation_resizer"></div>
    <div id="pma_navigation_collapser"></div>
    <div id="pma_navigation_content">
        <div id="pma_navigation_header">
            <div id="pmalogo">
                <a href="index.php">
                    <img id="imgpmalogo" src="./themes/img/logo_left.png" alt="phpMyAdmin">
                </a>

                <div id="navipanellinks">
                    <a href="index.php?route=/" title="Startseite"><img src="themes/dot.gif" title="Startseite"
                                                                        alt="Startseite" class="icon ic_b_home"></a>

                    <a class="logout disableAjax" href="index.php?route=/logout" title="Leere Sitzungsdaten"><img
                                src="themes/dot.gif" title="Leere Sitzungsdaten" alt="Leere Sitzungsdaten"
                                class="icon ic_s_loggoff"></a>

                    <a href="./doc/html/index.html" title="phpMyAdmin-Dokumentation" target="_blank"
                       rel="noopener noreferrer"><img src="themes/dot.gif" title="phpMyAdmin-Dokumentation"
                                                      alt="phpMyAdmin-Dokumentation" class="icon ic_b_docs"></a>

                    <a href="./url.php?url=https%3A%2F%2Fmariadb.com%2Fkb%2Fen%2Fdocumentation%2F"
                       title="MariaDB-Dokumentation" target="_blank" rel="noopener noreferrer"><img src="themes/dot.gif"
                                                                                                    title="MariaDB-Dokumentation"
                                                                                                    alt="MariaDB-Dokumentation"
                                                                                                    class="icon ic_b_sqlhelp"></a>

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

        <div id="pma_navigation_tree" class="list_container synced highlight autoexpand">

            <div class="pma_quick_warp">
                <div class="drop_list">
                    <button title="Letzte Tabellen" class="drop_button btn">Letzte</button>
                    <ul id="pma_recent_list">
                        <li class="warp_link">
                            <a href="index.php?route=/table/recent-favorite&db=annodomini_dev&table=account_permission">
                                `annodomini_dev`.`account_permission`
                            </a>
                        </li>
                        <li class="warp_link">
                            <a href="index.php?route=/table/recent-favorite&db=annodomini_dev&table=account">
                                `annodomini_dev`.`account`
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="drop_list">
                    <button title="Favoriten-Tabellen" class="drop_button btn">Favoriten</button>
                    <ul id="pma_favorite_list">
                        <li class="warp_link">
                            Es gibt keine Favoriten-Tabellen.
                        </li>
                    </ul>
                </div>
                <div class="clearfloat"></div>
            </div>
            <ul>

                <!-- CONTROLS START -->
                <li id="navigation_controls_outer">
                    <div id="navigation_controls">
                        <a href="#" id="pma_navigation_collapse" title="Alles auf-/zuklappen"><img src="themes/dot.gif"
                                                                                                   title="Alles auf-/zuklappen"
                                                                                                   alt="Alles auf-/zuklappen"
                                                                                                   class="icon ic_s_collapseall"></a>
                        <a href="#" id="pma_navigation_sync" title="Verknüpfung mit Hauptpanel aufheben"><img
                                    src="themes/dot.gif" title="Verknüpfung mit Hauptpanel aufheben"
                                    alt="Verknüpfung mit Hauptpanel aufheben" class="icon ic_s_link"></a>
                    </div>
                </li>
                <!-- CONTROLS ENDS -->

            </ul>


            <div id='pma_navigation_tree_content'>
                <ul>
                    <li class="first new_database italics">
                        <div class="block">
                            <i class="first"></i>
                        </div>

                        <div class="block second">
                            <a href="index.php?route=/server/databases"><img src="themes/dot.gif" title="Neu" alt="Neu"
                                                                             class="icon ic_b_newdb"></a>
                        </div>

                        <a class="hover_show_full" href="index.php?route=/server/databases" title="Neu">Neu</a>


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

                                    <a class="hover_show_full" href="index.php?route=/database/structure&db=annodomini"
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
                                       href="index.php?route=/database/structure&db=annodomini_dev" title="Struktur">annodomini_dev</a>


                                    <div class="clearfloat"></div>


                                </li>

                            </ul>
                        </div>

                    </li>
                    <li class="database">
                        <div class="block">
                            <i></i>
                            <b></b>
                            <a class="expander" href="#">
                                <span class="hide paths_nav" data-apath="cm9vdA==.YmV3ZWd0dW50ZV9jbnRuZA=="
                                      data-vpath="cm9vdA==.YmV3ZWd0dW50ZV9jbnRuZA==" data-pos="0"></span>
                                <img src="themes/dot.gif" title="Auf-/Zuklappen" alt="Auf-/Zuklappen"
                                     class="icon ic_b_plus">
                            </a>
                        </div>

                        <div class="block second">
                            <a href="index.php?route=/database/operations&db=bewegtunte_cntnd"><img src="themes/dot.gif"
                                                                                                    title="Datenbank-Operationen"
                                                                                                    alt="Datenbank-Operationen"
                                                                                                    class="icon ic_s_db"></a>
                        </div>

                        <a class="hover_show_full" href="index.php?route=/database/structure&db=bewegtunte_cntnd"
                           title="Struktur">bewegtunte_cntnd</a>


                        <div class="clearfloat"></div>


                    </li>
                    <li class="last database">
                        <div class="block">
                            <i></i>

                            <a class="expander" href="#">
                                <span class="hide paths_nav" data-apath="cm9vdA==.dGVzdA=="
                                      data-vpath="cm9vdA==.dGVzdA==" data-pos="0"></span>
                                <img src="themes/dot.gif" title="Auf-/Zuklappen" alt="Auf-/Zuklappen"
                                     class="icon ic_b_plus">
                            </a>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-label="Navigation umschalten" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav" style="width: auto; overflow: visible;">
                <ul id="topmenu" class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/databases">
                            <img src="themes/dot.gif" title="Datenbanken" alt="Datenbanken" class="icon ic_s_db">&nbsp;Datenbanken
                            <span class="visually-hidden">(aktuelle)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/sql">
                            <img src="themes/dot.gif" title="SQL" alt="SQL" class="icon ic_b_sql">&nbsp;SQL
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/status">
                            <img src="themes/dot.gif" title="Status" alt="Status" class="icon ic_s_status">&nbsp;Status
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap"
                           href="index.php?route=/server/privileges&amp;viewing_mode=server">
                            <img src="themes/dot.gif" title="Benutzerkonten" alt="Benutzerkonten"
                                 class="icon ic_s_rights">&nbsp;Benutzerkonten
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/export">
                            <img src="themes/dot.gif" title="Exportieren" alt="Exportieren" class="icon ic_b_export">&nbsp;Exportieren
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/import">
                            <img src="themes/dot.gif" title="Importieren" alt="Importieren" class="icon ic_b_import">&nbsp;Importieren
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/preferences/manage">
                            <img src="themes/dot.gif" title="Einstellungen" alt="Einstellungen"
                                 class="icon ic_b_tblops">&nbsp;Einstellungen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/replication">
                            <img src="themes/dot.gif" title="Replikation" alt="Replikation"
                                 class="icon ic_s_replication">&nbsp;Replikation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="index.php?route=/server/variables">
                            <img src="themes/dot.gif" title="Variablen" alt="Variablen" class="icon ic_s_vars">&nbsp;Variablen
                        </a>
                    </li>


                    <li class="nav-item dropdown" style=""><a href="#" class="nav-link dropdown-toggle"
                                                              id="navbarDropdown" role="button"
                                                              data-bs-toggle="dropdown" aria-haspopup="true"
                                                              aria-expanded="false"><img alt="" title=""
                                                                                         src="themes/dot.gif"
                                                                                         class="icon ic_b_more">Mehr</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li class="dropdown-item">
                                <a class="nav-link text-nowrap" href="index.php?route=/server/collations">
                                    <img src="themes/dot.gif" title="Zeichensätze" alt="Zeichensätze"
                                         class="icon ic_s_asci">&nbsp;Zeichensätze
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link text-nowrap" href="index.php?route=/server/engines">
                                    <img src="themes/dot.gif" title="Formate" alt="Formate" class="icon ic_b_engine">&nbsp;Formate
                                </a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link text-nowrap" href="index.php?route=/server/plugins">
                                    <img src="themes/dot.gif" title="Erweiterungen" alt="Erweiterungen"
                                         class="icon ic_b_plugin">&nbsp;Erweiterungen
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>


<div id="page_content">

    <div class="container-fluid my-3">
        <h2>
            <span class="text-nowrap"><img src="themes/dot.gif" title="Datenbanken" alt="Datenbanken"
                                           class="icon ic_s_db">&nbsp;Datenbanken</span>
        </h2>

        <div class="card">
            <div class="card-header">
                <span class="text-nowrap"><img src="themes/dot.gif" title="Neue Datenbank anlegen"
                                               alt="Neue Datenbank anlegen" class="icon ic_b_newdb">&nbsp;Neue Datenbank anlegen</span>
                <a href="./url.php?url=https%3A%2F%2Fdev.mysql.com%2Fdoc%2Frefman%2F8.0%2Fen%2Fcreate-database.html"
                   target="mysql_doc"><img src="themes/dot.gif" title="Dokumentation" alt="Dokumentation"
                                           class="icon ic_b_help"></a>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?route=/server/databases/create" id="create_database_form"
                      class="ajax row row-cols-md-auto g-3 align-items-center">
                    <input type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
                    <input type="hidden" name="reload" value="1">

                    <div class="col-12">
                        <input type="text" name="new_db" maxlength="64" class="form-control" value=""
                               id="text_create_db" placeholder="Datenbankname" aria-label="Datenbankname" required="">
                    </div>

                    <div class="col-12">
                        <select lang="en" dir="ltr" name="db_collation" class="form-select" aria-label="Kollation">
                            <option value="">Kollation</option>
                            <option value=""></option>
                            <optgroup label="armscii8" title="ARMSCII-8 Armenian">
                                <option value="armscii8_bin" title="Armenisch, Binär">armscii8_bin</option>
                                <option value="armscii8_general_ci"
                                        title="Armenisch, Beachtet nicht Groß- und Kleinschreibung">armscii8_general_ci
                                </option>
                                <option value="armscii8_general_nopad_ci"
                                        title="Armenisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    armscii8_general_nopad_ci
                                </option>
                                <option value="armscii8_nopad_bin" title="Armenisch, no-pad, Binär">armscii8_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="ascii" title="US ASCII">
                                <option value="ascii_bin" title="Westeuropäisch, Binär">ascii_bin</option>
                                <option value="ascii_general_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    ascii_general_ci
                                </option>
                                <option value="ascii_general_nopad_ci"
                                        title="Westeuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    ascii_general_nopad_ci
                                </option>
                                <option value="ascii_nopad_bin" title="Westeuropäisch, no-pad, Binär">ascii_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="big5" title="Big5 Traditional Chinese">
                                <option value="big5_bin" title="Traditionelles Chinesisch, Binär">big5_bin</option>
                                <option value="big5_chinese_ci"
                                        title="Traditionelles Chinesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    big5_chinese_ci
                                </option>
                                <option value="big5_chinese_nopad_ci"
                                        title="Traditionelles Chinesisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    big5_chinese_nopad_ci
                                </option>
                                <option value="big5_nopad_bin" title="Traditionelles Chinesisch, no-pad, Binär">
                                    big5_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="binary" title="Binary pseudo charset">
                                <option value="binary" title="Binär">binary</option>
                            </optgroup>
                            <optgroup label="cp1250" title="Windows Central European">
                                <option value="cp1250_bin" title="Mitteleuropäisch, Binär">cp1250_bin</option>
                                <option value="cp1250_croatian_ci"
                                        title="Kroatisch, Beachtet nicht Groß- und Kleinschreibung">cp1250_croatian_ci
                                </option>
                                <option value="cp1250_czech_cs" title="Tschechisch, Beachtet Groß- und Kleinschreibung">
                                    cp1250_czech_cs
                                </option>
                                <option value="cp1250_general_ci"
                                        title="Mitteleuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    cp1250_general_ci
                                </option>
                                <option value="cp1250_general_nopad_ci"
                                        title="Mitteleuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp1250_general_nopad_ci
                                </option>
                                <option value="cp1250_nopad_bin" title="Mitteleuropäisch, no-pad, Binär">
                                    cp1250_nopad_bin
                                </option>
                                <option value="cp1250_polish_ci"
                                        title="Polnisch, Beachtet nicht Groß- und Kleinschreibung">cp1250_polish_ci
                                </option>
                            </optgroup>
                            <optgroup label="cp1251" title="Windows Cyrillic">
                                <option value="cp1251_bin" title="Kyrillisch, Binär">cp1251_bin</option>
                                <option value="cp1251_bulgarian_ci"
                                        title="Bulgarisch, Beachtet nicht Groß- und Kleinschreibung">cp1251_bulgarian_ci
                                </option>
                                <option value="cp1251_general_ci"
                                        title="Kyrillisch, Beachtet nicht Groß- und Kleinschreibung">cp1251_general_ci
                                </option>
                                <option value="cp1251_general_cs"
                                        title="Kyrillisch, Beachtet Groß- und Kleinschreibung">cp1251_general_cs
                                </option>
                                <option value="cp1251_general_nopad_ci"
                                        title="Kyrillisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp1251_general_nopad_ci
                                </option>
                                <option value="cp1251_nopad_bin" title="Kyrillisch, no-pad, Binär">cp1251_nopad_bin
                                </option>
                                <option value="cp1251_ukrainian_ci"
                                        title="Ukrainisch, Beachtet nicht Groß- und Kleinschreibung">cp1251_ukrainian_ci
                                </option>
                            </optgroup>
                            <optgroup label="cp1256" title="Windows Arabic">
                                <option value="cp1256_bin" title="Arabisch, Binär">cp1256_bin</option>
                                <option value="cp1256_general_ci"
                                        title="Arabisch, Beachtet nicht Groß- und Kleinschreibung">cp1256_general_ci
                                </option>
                                <option value="cp1256_general_nopad_ci"
                                        title="Arabisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp1256_general_nopad_ci
                                </option>
                                <option value="cp1256_nopad_bin" title="Arabisch, no-pad, Binär">cp1256_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="cp1257" title="Windows Baltic">
                                <option value="cp1257_bin" title="Baltisch, Binär">cp1257_bin</option>
                                <option value="cp1257_general_ci"
                                        title="Baltisch, Beachtet nicht Groß- und Kleinschreibung">cp1257_general_ci
                                </option>
                                <option value="cp1257_general_nopad_ci"
                                        title="Baltisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp1257_general_nopad_ci
                                </option>
                                <option value="cp1257_lithuanian_ci"
                                        title="Litauisch, Beachtet nicht Groß- und Kleinschreibung">cp1257_lithuanian_ci
                                </option>
                                <option value="cp1257_nopad_bin" title="Baltisch, no-pad, Binär">cp1257_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="cp850" title="DOS West European">
                                <option value="cp850_bin" title="Westeuropäisch, Binär">cp850_bin</option>
                                <option value="cp850_general_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    cp850_general_ci
                                </option>
                                <option value="cp850_general_nopad_ci"
                                        title="Westeuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp850_general_nopad_ci
                                </option>
                                <option value="cp850_nopad_bin" title="Westeuropäisch, no-pad, Binär">cp850_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="cp852" title="DOS Central European">
                                <option value="cp852_bin" title="Mitteleuropäisch, Binär">cp852_bin</option>
                                <option value="cp852_general_ci"
                                        title="Mitteleuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    cp852_general_ci
                                </option>
                                <option value="cp852_general_nopad_ci"
                                        title="Mitteleuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp852_general_nopad_ci
                                </option>
                                <option value="cp852_nopad_bin" title="Mitteleuropäisch, no-pad, Binär">
                                    cp852_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="cp866" title="DOS Russian">
                                <option value="cp866_bin" title="Russisch, Binär">cp866_bin</option>
                                <option value="cp866_general_ci"
                                        title="Russisch, Beachtet nicht Groß- und Kleinschreibung">cp866_general_ci
                                </option>
                                <option value="cp866_general_nopad_ci"
                                        title="Russisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp866_general_nopad_ci
                                </option>
                                <option value="cp866_nopad_bin" title="Russisch, no-pad, Binär">cp866_nopad_bin</option>
                            </optgroup>
                            <optgroup label="cp932" title="SJIS for Windows Japanese">
                                <option value="cp932_bin" title="Japanisch, Binär">cp932_bin</option>
                                <option value="cp932_japanese_ci"
                                        title="Japanisch, Beachtet nicht Groß- und Kleinschreibung">cp932_japanese_ci
                                </option>
                                <option value="cp932_japanese_nopad_ci"
                                        title="Japanisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    cp932_japanese_nopad_ci
                                </option>
                                <option value="cp932_nopad_bin" title="Japanisch, no-pad, Binär">cp932_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="dec8" title="DEC West European">
                                <option value="dec8_bin" title="Westeuropäisch, Binär">dec8_bin</option>
                                <option value="dec8_nopad_bin" title="Westeuropäisch, no-pad, Binär">dec8_nopad_bin
                                </option>
                                <option value="dec8_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">dec8_swedish_ci
                                </option>
                                <option value="dec8_swedish_nopad_ci"
                                        title="Schwedisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    dec8_swedish_nopad_ci
                                </option>
                            </optgroup>
                            <optgroup label="eucjpms" title="UJIS for Windows Japanese">
                                <option value="eucjpms_bin" title="Japanisch, Binär">eucjpms_bin</option>
                                <option value="eucjpms_japanese_ci"
                                        title="Japanisch, Beachtet nicht Groß- und Kleinschreibung">eucjpms_japanese_ci
                                </option>
                                <option value="eucjpms_japanese_nopad_ci"
                                        title="Japanisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    eucjpms_japanese_nopad_ci
                                </option>
                                <option value="eucjpms_nopad_bin" title="Japanisch, no-pad, Binär">eucjpms_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="euckr" title="EUC-KR Korean">
                                <option value="euckr_bin" title="Koreanisch, Binär">euckr_bin</option>
                                <option value="euckr_korean_ci"
                                        title="Koreanisch, Beachtet nicht Groß- und Kleinschreibung">euckr_korean_ci
                                </option>
                                <option value="euckr_korean_nopad_ci"
                                        title="Koreanisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    euckr_korean_nopad_ci
                                </option>
                                <option value="euckr_nopad_bin" title="Koreanisch, no-pad, Binär">euckr_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="gb2312" title="GB2312 Simplified Chinese">
                                <option value="gb2312_bin" title="Vereinfachtes Chinesisch, Binär">gb2312_bin</option>
                                <option value="gb2312_chinese_ci"
                                        title="Vereinfachtes Chinesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    gb2312_chinese_ci
                                </option>
                                <option value="gb2312_chinese_nopad_ci"
                                        title="Vereinfachtes Chinesisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    gb2312_chinese_nopad_ci
                                </option>
                                <option value="gb2312_nopad_bin" title="Vereinfachtes Chinesisch, no-pad, Binär">
                                    gb2312_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="gbk" title="GBK Simplified Chinese">
                                <option value="gbk_bin" title="Vereinfachtes Chinesisch, Binär">gbk_bin</option>
                                <option value="gbk_chinese_ci"
                                        title="Vereinfachtes Chinesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    gbk_chinese_ci
                                </option>
                                <option value="gbk_chinese_nopad_ci"
                                        title="Vereinfachtes Chinesisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    gbk_chinese_nopad_ci
                                </option>
                                <option value="gbk_nopad_bin" title="Vereinfachtes Chinesisch, no-pad, Binär">
                                    gbk_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="geostd8" title="GEOSTD8 Georgian">
                                <option value="geostd8_bin" title="Georgisch, Binär">geostd8_bin</option>
                                <option value="geostd8_general_ci"
                                        title="Georgisch, Beachtet nicht Groß- und Kleinschreibung">geostd8_general_ci
                                </option>
                                <option value="geostd8_general_nopad_ci"
                                        title="Georgisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    geostd8_general_nopad_ci
                                </option>
                                <option value="geostd8_nopad_bin" title="Georgisch, no-pad, Binär">geostd8_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="greek" title="ISO 8859-7 Greek">
                                <option value="greek_bin" title="Griechisch, Binär">greek_bin</option>
                                <option value="greek_general_ci"
                                        title="Griechisch, Beachtet nicht Groß- und Kleinschreibung">greek_general_ci
                                </option>
                                <option value="greek_general_nopad_ci"
                                        title="Griechisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    greek_general_nopad_ci
                                </option>
                                <option value="greek_nopad_bin" title="Griechisch, no-pad, Binär">greek_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="hebrew" title="ISO 8859-8 Hebrew">
                                <option value="hebrew_bin" title="Hebräisch, Binär">hebrew_bin</option>
                                <option value="hebrew_general_ci"
                                        title="Hebräisch, Beachtet nicht Groß- und Kleinschreibung">hebrew_general_ci
                                </option>
                                <option value="hebrew_general_nopad_ci"
                                        title="Hebräisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    hebrew_general_nopad_ci
                                </option>
                                <option value="hebrew_nopad_bin" title="Hebräisch, no-pad, Binär">hebrew_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="hp8" title="HP West European">
                                <option value="hp8_bin" title="Westeuropäisch, Binär">hp8_bin</option>
                                <option value="hp8_english_ci"
                                        title="Englisch, Beachtet nicht Groß- und Kleinschreibung">hp8_english_ci
                                </option>
                                <option value="hp8_english_nopad_ci"
                                        title="Englisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    hp8_english_nopad_ci
                                </option>
                                <option value="hp8_nopad_bin" title="Westeuropäisch, no-pad, Binär">hp8_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="keybcs2" title="DOS Kamenicky Czech-Slovak">
                                <option value="keybcs2_bin" title="Tschechoslowakisch, Binär">keybcs2_bin</option>
                                <option value="keybcs2_general_ci"
                                        title="Tschechoslowakisch, Beachtet nicht Groß- und Kleinschreibung">
                                    keybcs2_general_ci
                                </option>
                                <option value="keybcs2_general_nopad_ci"
                                        title="Tschechoslowakisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    keybcs2_general_nopad_ci
                                </option>
                                <option value="keybcs2_nopad_bin" title="Tschechoslowakisch, no-pad, Binär">
                                    keybcs2_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="koi8r" title="KOI8-R Relcom Russian">
                                <option value="koi8r_bin" title="Russisch, Binär">koi8r_bin</option>
                                <option value="koi8r_general_ci"
                                        title="Russisch, Beachtet nicht Groß- und Kleinschreibung">koi8r_general_ci
                                </option>
                                <option value="koi8r_general_nopad_ci"
                                        title="Russisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    koi8r_general_nopad_ci
                                </option>
                                <option value="koi8r_nopad_bin" title="Russisch, no-pad, Binär">koi8r_nopad_bin</option>
                            </optgroup>
                            <optgroup label="koi8u" title="KOI8-U Ukrainian">
                                <option value="koi8u_bin" title="Ukrainisch, Binär">koi8u_bin</option>
                                <option value="koi8u_general_ci"
                                        title="Ukrainisch, Beachtet nicht Groß- und Kleinschreibung">koi8u_general_ci
                                </option>
                                <option value="koi8u_general_nopad_ci"
                                        title="Ukrainisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    koi8u_general_nopad_ci
                                </option>
                                <option value="koi8u_nopad_bin" title="Ukrainisch, no-pad, Binär">koi8u_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="latin1" title="cp1252 West European">
                                <option value="latin1_bin" title="Westeuropäisch, Binär">latin1_bin</option>
                                <option value="latin1_danish_ci"
                                        title="Dänisch, Beachtet nicht Groß- und Kleinschreibung">latin1_danish_ci
                                </option>
                                <option value="latin1_general_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    latin1_general_ci
                                </option>
                                <option value="latin1_general_cs"
                                        title="Westeuropäisch, Beachtet Groß- und Kleinschreibung">latin1_general_cs
                                </option>
                                <option value="latin1_german1_ci"
                                        title="Deutsch (Strukturverzeichnis), Beachtet nicht Groß- und Kleinschreibung">
                                    latin1_german1_ci
                                </option>
                                <option value="latin1_german2_ci"
                                        title="Deutsch (Telefonbuchverzeichnis), Beachtet nicht Groß- und Kleinschreibung">
                                    latin1_german2_ci
                                </option>
                                <option value="latin1_nopad_bin" title="Westeuropäisch, no-pad, Binär">
                                    latin1_nopad_bin
                                </option>
                                <option value="latin1_spanish_ci"
                                        title="Spanisch (modern), Beachtet nicht Groß- und Kleinschreibung">
                                    latin1_spanish_ci
                                </option>
                                <option value="latin1_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">latin1_swedish_ci
                                </option>
                                <option value="latin1_swedish_nopad_ci"
                                        title="Schwedisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    latin1_swedish_nopad_ci
                                </option>
                            </optgroup>
                            <optgroup label="latin2" title="ISO 8859-2 Central European">
                                <option value="latin2_bin" title="Mitteleuropäisch, Binär">latin2_bin</option>
                                <option value="latin2_croatian_ci"
                                        title="Kroatisch, Beachtet nicht Groß- und Kleinschreibung">latin2_croatian_ci
                                </option>
                                <option value="latin2_czech_cs" title="Tschechisch, Beachtet Groß- und Kleinschreibung">
                                    latin2_czech_cs
                                </option>
                                <option value="latin2_general_ci"
                                        title="Mitteleuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    latin2_general_ci
                                </option>
                                <option value="latin2_general_nopad_ci"
                                        title="Mitteleuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    latin2_general_nopad_ci
                                </option>
                                <option value="latin2_hungarian_ci"
                                        title="Ungarisch, Beachtet nicht Groß- und Kleinschreibung">latin2_hungarian_ci
                                </option>
                                <option value="latin2_nopad_bin" title="Mitteleuropäisch, no-pad, Binär">
                                    latin2_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="latin5" title="ISO 8859-9 Turkish">
                                <option value="latin5_bin" title="Türkisch, Binär">latin5_bin</option>
                                <option value="latin5_nopad_bin" title="Türkisch, no-pad, Binär">latin5_nopad_bin
                                </option>
                                <option value="latin5_turkish_ci"
                                        title="Türkisch, Beachtet nicht Groß- und Kleinschreibung">latin5_turkish_ci
                                </option>
                                <option value="latin5_turkish_nopad_ci"
                                        title="Türkisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    latin5_turkish_nopad_ci
                                </option>
                            </optgroup>
                            <optgroup label="latin7" title="ISO 8859-13 Baltic">
                                <option value="latin7_bin" title="Baltisch, Binär">latin7_bin</option>
                                <option value="latin7_estonian_cs" title="Estnisch, Beachtet Groß- und Kleinschreibung">
                                    latin7_estonian_cs
                                </option>
                                <option value="latin7_general_ci"
                                        title="Baltisch, Beachtet nicht Groß- und Kleinschreibung">latin7_general_ci
                                </option>
                                <option value="latin7_general_cs" title="Baltisch, Beachtet Groß- und Kleinschreibung">
                                    latin7_general_cs
                                </option>
                                <option value="latin7_general_nopad_ci"
                                        title="Baltisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    latin7_general_nopad_ci
                                </option>
                                <option value="latin7_nopad_bin" title="Baltisch, no-pad, Binär">latin7_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="macce" title="Mac Central European">
                                <option value="macce_bin" title="Mitteleuropäisch, Binär">macce_bin</option>
                                <option value="macce_general_ci"
                                        title="Mitteleuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    macce_general_ci
                                </option>
                                <option value="macce_general_nopad_ci"
                                        title="Mitteleuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    macce_general_nopad_ci
                                </option>
                                <option value="macce_nopad_bin" title="Mitteleuropäisch, no-pad, Binär">
                                    macce_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="macroman" title="Mac West European">
                                <option value="macroman_bin" title="Westeuropäisch, Binär">macroman_bin</option>
                                <option value="macroman_general_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">
                                    macroman_general_ci
                                </option>
                                <option value="macroman_general_nopad_ci"
                                        title="Westeuropäisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    macroman_general_nopad_ci
                                </option>
                                <option value="macroman_nopad_bin" title="Westeuropäisch, no-pad, Binär">
                                    macroman_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="sjis" title="Shift-JIS Japanese">
                                <option value="sjis_bin" title="Japanisch, Binär">sjis_bin</option>
                                <option value="sjis_japanese_ci"
                                        title="Japanisch, Beachtet nicht Groß- und Kleinschreibung">sjis_japanese_ci
                                </option>
                                <option value="sjis_japanese_nopad_ci"
                                        title="Japanisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    sjis_japanese_nopad_ci
                                </option>
                                <option value="sjis_nopad_bin" title="Japanisch, no-pad, Binär">sjis_nopad_bin</option>
                            </optgroup>
                            <optgroup label="swe7" title="7bit Swedish">
                                <option value="swe7_bin" title="Schwedisch, Binär">swe7_bin</option>
                                <option value="swe7_nopad_bin" title="Schwedisch, no-pad, Binär">swe7_nopad_bin</option>
                                <option value="swe7_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">swe7_swedish_ci
                                </option>
                                <option value="swe7_swedish_nopad_ci"
                                        title="Schwedisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    swe7_swedish_nopad_ci
                                </option>
                            </optgroup>
                            <optgroup label="tis620" title="TIS620 Thai">
                                <option value="tis620_bin" title="Thai, Binär">tis620_bin</option>
                                <option value="tis620_nopad_bin" title="Thai, no-pad, Binär">tis620_nopad_bin</option>
                                <option value="tis620_thai_ci" title="Thai, Beachtet nicht Groß- und Kleinschreibung">
                                    tis620_thai_ci
                                </option>
                                <option value="tis620_thai_nopad_ci"
                                        title="Thai, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    tis620_thai_nopad_ci
                                </option>
                            </optgroup>
                            <optgroup label="ucs2" title="UCS-2 Unicode">
                                <option value="ucs2_bin" title="Unicode, Binär">ucs2_bin</option>
                                <option value="ucs2_croatian_ci"
                                        title="Kroatisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_croatian_ci
                                </option>
                                <option value="ucs2_croatian_mysql561_ci"
                                        title="Kroatisch (MySQL 5.6.1), Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_croatian_mysql561_ci
                                </option>
                                <option value="ucs2_czech_ci"
                                        title="Tschechisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_czech_ci
                                </option>
                                <option value="ucs2_danish_ci"
                                        title="Dänisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_danish_ci
                                </option>
                                <option value="ucs2_esperanto_ci"
                                        title="Esperanto, Beachtet nicht Groß- und Kleinschreibung">ucs2_esperanto_ci
                                </option>
                                <option value="ucs2_estonian_ci"
                                        title="Estnisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_estonian_ci
                                </option>
                                <option value="ucs2_general_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">ucs2_general_ci
                                </option>
                                <option value="ucs2_general_mysql500_ci"
                                        title="Unicode (MySQL 5.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_general_mysql500_ci
                                </option>
                                <option value="ucs2_general_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_general_nopad_ci
                                </option>
                                <option value="ucs2_german2_ci"
                                        title="Deutsch (Telefonbuchverzeichnis), Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_german2_ci
                                </option>
                                <option value="ucs2_hungarian_ci"
                                        title="Ungarisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_hungarian_ci
                                </option>
                                <option value="ucs2_icelandic_ci"
                                        title="Isländisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_icelandic_ci
                                </option>
                                <option value="ucs2_latvian_ci"
                                        title="Lettisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_latvian_ci
                                </option>
                                <option value="ucs2_lithuanian_ci"
                                        title="Litauisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_lithuanian_ci
                                </option>
                                <option value="ucs2_myanmar_ci"
                                        title="Birmanisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_myanmar_ci
                                </option>
                                <option value="ucs2_nopad_bin" title="Unicode, no-pad, Binär">ucs2_nopad_bin</option>
                                <option value="ucs2_persian_ci"
                                        title="Persisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_persian_ci
                                </option>
                                <option value="ucs2_polish_ci"
                                        title="Polnisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_polish_ci
                                </option>
                                <option value="ucs2_roman_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_roman_ci
                                </option>
                                <option value="ucs2_romanian_ci"
                                        title="Rumänisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_romanian_ci
                                </option>
                                <option value="ucs2_sinhala_ci"
                                        title="Singhalesisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_sinhala_ci
                                </option>
                                <option value="ucs2_slovak_ci"
                                        title="Slovakisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_slovak_ci
                                </option>
                                <option value="ucs2_slovenian_ci"
                                        title="Slovenisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_slovenian_ci
                                </option>
                                <option value="ucs2_spanish2_ci"
                                        title="Spanisch (traditionell), Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_spanish2_ci
                                </option>
                                <option value="ucs2_spanish_ci"
                                        title="Spanisch (modern), Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_spanish_ci
                                </option>
                                <option value="ucs2_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_swedish_ci
                                </option>
                                <option value="ucs2_thai_520_w2" title="Thai (UCA 5.2.0), mehrschichtig">
                                    ucs2_thai_520_w2
                                </option>
                                <option value="ucs2_turkish_ci"
                                        title="Türkisch, Beachtet nicht Groß- und Kleinschreibung">ucs2_turkish_ci
                                </option>
                                <option value="ucs2_unicode_520_ci"
                                        title="Unicode (UCA 5.2.0), Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_unicode_520_ci
                                </option>
                                <option value="ucs2_unicode_520_nopad_ci"
                                        title="Unicode (UCA 5.2.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_unicode_520_nopad_ci
                                </option>
                                <option value="ucs2_unicode_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">ucs2_unicode_ci
                                </option>
                                <option value="ucs2_unicode_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_unicode_nopad_ci
                                </option>
                                <option value="ucs2_vietnamese_ci"
                                        title="Vietnamesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    ucs2_vietnamese_ci
                                </option>
                            </optgroup>
                            <optgroup label="ujis" title="EUC-JP Japanese">
                                <option value="ujis_bin" title="Japanisch, Binär">ujis_bin</option>
                                <option value="ujis_japanese_ci"
                                        title="Japanisch, Beachtet nicht Groß- und Kleinschreibung">ujis_japanese_ci
                                </option>
                                <option value="ujis_japanese_nopad_ci"
                                        title="Japanisch, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    ujis_japanese_nopad_ci
                                </option>
                                <option value="ujis_nopad_bin" title="Japanisch, no-pad, Binär">ujis_nopad_bin</option>
                            </optgroup>
                            <optgroup label="utf16" title="UTF-16 Unicode">
                                <option value="utf16_bin" title="Unicode, Binär">utf16_bin</option>
                                <option value="utf16_croatian_ci"
                                        title="Kroatisch, Beachtet nicht Groß- und Kleinschreibung">utf16_croatian_ci
                                </option>
                                <option value="utf16_croatian_mysql561_ci"
                                        title="Kroatisch (MySQL 5.6.1), Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_croatian_mysql561_ci
                                </option>
                                <option value="utf16_czech_ci"
                                        title="Tschechisch, Beachtet nicht Groß- und Kleinschreibung">utf16_czech_ci
                                </option>
                                <option value="utf16_danish_ci"
                                        title="Dänisch, Beachtet nicht Groß- und Kleinschreibung">utf16_danish_ci
                                </option>
                                <option value="utf16_esperanto_ci"
                                        title="Esperanto, Beachtet nicht Groß- und Kleinschreibung">utf16_esperanto_ci
                                </option>
                                <option value="utf16_estonian_ci"
                                        title="Estnisch, Beachtet nicht Groß- und Kleinschreibung">utf16_estonian_ci
                                </option>
                                <option value="utf16_general_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf16_general_ci
                                </option>
                                <option value="utf16_general_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_general_nopad_ci
                                </option>
                                <option value="utf16_german2_ci"
                                        title="Deutsch (Telefonbuchverzeichnis), Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_german2_ci
                                </option>
                                <option value="utf16_hungarian_ci"
                                        title="Ungarisch, Beachtet nicht Groß- und Kleinschreibung">utf16_hungarian_ci
                                </option>
                                <option value="utf16_icelandic_ci"
                                        title="Isländisch, Beachtet nicht Groß- und Kleinschreibung">utf16_icelandic_ci
                                </option>
                                <option value="utf16_latvian_ci"
                                        title="Lettisch, Beachtet nicht Groß- und Kleinschreibung">utf16_latvian_ci
                                </option>
                                <option value="utf16_lithuanian_ci"
                                        title="Litauisch, Beachtet nicht Groß- und Kleinschreibung">utf16_lithuanian_ci
                                </option>
                                <option value="utf16_myanmar_ci"
                                        title="Birmanisch, Beachtet nicht Groß- und Kleinschreibung">utf16_myanmar_ci
                                </option>
                                <option value="utf16_nopad_bin" title="Unicode, no-pad, Binär">utf16_nopad_bin</option>
                                <option value="utf16_persian_ci"
                                        title="Persisch, Beachtet nicht Groß- und Kleinschreibung">utf16_persian_ci
                                </option>
                                <option value="utf16_polish_ci"
                                        title="Polnisch, Beachtet nicht Groß- und Kleinschreibung">utf16_polish_ci
                                </option>
                                <option value="utf16_roman_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">utf16_roman_ci
                                </option>
                                <option value="utf16_romanian_ci"
                                        title="Rumänisch, Beachtet nicht Groß- und Kleinschreibung">utf16_romanian_ci
                                </option>
                                <option value="utf16_sinhala_ci"
                                        title="Singhalesisch, Beachtet nicht Groß- und Kleinschreibung">utf16_sinhala_ci
                                </option>
                                <option value="utf16_slovak_ci"
                                        title="Slovakisch, Beachtet nicht Groß- und Kleinschreibung">utf16_slovak_ci
                                </option>
                                <option value="utf16_slovenian_ci"
                                        title="Slovenisch, Beachtet nicht Groß- und Kleinschreibung">utf16_slovenian_ci
                                </option>
                                <option value="utf16_spanish2_ci"
                                        title="Spanisch (traditionell), Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_spanish2_ci
                                </option>
                                <option value="utf16_spanish_ci"
                                        title="Spanisch (modern), Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_spanish_ci
                                </option>
                                <option value="utf16_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">utf16_swedish_ci
                                </option>
                                <option value="utf16_thai_520_w2" title="Thai (UCA 5.2.0), mehrschichtig">
                                    utf16_thai_520_w2
                                </option>
                                <option value="utf16_turkish_ci"
                                        title="Türkisch, Beachtet nicht Groß- und Kleinschreibung">utf16_turkish_ci
                                </option>
                                <option value="utf16_unicode_520_ci"
                                        title="Unicode (UCA 5.2.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_unicode_520_ci
                                </option>
                                <option value="utf16_unicode_520_nopad_ci"
                                        title="Unicode (UCA 5.2.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_unicode_520_nopad_ci
                                </option>
                                <option value="utf16_unicode_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf16_unicode_ci
                                </option>
                                <option value="utf16_unicode_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_unicode_nopad_ci
                                </option>
                                <option value="utf16_vietnamese_ci"
                                        title="Vietnamesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    utf16_vietnamese_ci
                                </option>
                            </optgroup>
                            <optgroup label="utf16le" title="UTF-16LE Unicode">
                                <option value="utf16le_bin" title="Unicode, Binär">utf16le_bin</option>
                                <option value="utf16le_general_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf16le_general_ci
                                </option>
                                <option value="utf16le_general_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf16le_general_nopad_ci
                                </option>
                                <option value="utf16le_nopad_bin" title="Unicode, no-pad, Binär">utf16le_nopad_bin
                                </option>
                            </optgroup>
                            <optgroup label="utf32" title="UTF-32 Unicode">
                                <option value="utf32_bin" title="Unicode, Binär">utf32_bin</option>
                                <option value="utf32_croatian_ci"
                                        title="Kroatisch, Beachtet nicht Groß- und Kleinschreibung">utf32_croatian_ci
                                </option>
                                <option value="utf32_croatian_mysql561_ci"
                                        title="Kroatisch (MySQL 5.6.1), Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_croatian_mysql561_ci
                                </option>
                                <option value="utf32_czech_ci"
                                        title="Tschechisch, Beachtet nicht Groß- und Kleinschreibung">utf32_czech_ci
                                </option>
                                <option value="utf32_danish_ci"
                                        title="Dänisch, Beachtet nicht Groß- und Kleinschreibung">utf32_danish_ci
                                </option>
                                <option value="utf32_esperanto_ci"
                                        title="Esperanto, Beachtet nicht Groß- und Kleinschreibung">utf32_esperanto_ci
                                </option>
                                <option value="utf32_estonian_ci"
                                        title="Estnisch, Beachtet nicht Groß- und Kleinschreibung">utf32_estonian_ci
                                </option>
                                <option value="utf32_general_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf32_general_ci
                                </option>
                                <option value="utf32_general_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_general_nopad_ci
                                </option>
                                <option value="utf32_german2_ci"
                                        title="Deutsch (Telefonbuchverzeichnis), Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_german2_ci
                                </option>
                                <option value="utf32_hungarian_ci"
                                        title="Ungarisch, Beachtet nicht Groß- und Kleinschreibung">utf32_hungarian_ci
                                </option>
                                <option value="utf32_icelandic_ci"
                                        title="Isländisch, Beachtet nicht Groß- und Kleinschreibung">utf32_icelandic_ci
                                </option>
                                <option value="utf32_latvian_ci"
                                        title="Lettisch, Beachtet nicht Groß- und Kleinschreibung">utf32_latvian_ci
                                </option>
                                <option value="utf32_lithuanian_ci"
                                        title="Litauisch, Beachtet nicht Groß- und Kleinschreibung">utf32_lithuanian_ci
                                </option>
                                <option value="utf32_myanmar_ci"
                                        title="Birmanisch, Beachtet nicht Groß- und Kleinschreibung">utf32_myanmar_ci
                                </option>
                                <option value="utf32_nopad_bin" title="Unicode, no-pad, Binär">utf32_nopad_bin</option>
                                <option value="utf32_persian_ci"
                                        title="Persisch, Beachtet nicht Groß- und Kleinschreibung">utf32_persian_ci
                                </option>
                                <option value="utf32_polish_ci"
                                        title="Polnisch, Beachtet nicht Groß- und Kleinschreibung">utf32_polish_ci
                                </option>
                                <option value="utf32_roman_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">utf32_roman_ci
                                </option>
                                <option value="utf32_romanian_ci"
                                        title="Rumänisch, Beachtet nicht Groß- und Kleinschreibung">utf32_romanian_ci
                                </option>
                                <option value="utf32_sinhala_ci"
                                        title="Singhalesisch, Beachtet nicht Groß- und Kleinschreibung">utf32_sinhala_ci
                                </option>
                                <option value="utf32_slovak_ci"
                                        title="Slovakisch, Beachtet nicht Groß- und Kleinschreibung">utf32_slovak_ci
                                </option>
                                <option value="utf32_slovenian_ci"
                                        title="Slovenisch, Beachtet nicht Groß- und Kleinschreibung">utf32_slovenian_ci
                                </option>
                                <option value="utf32_spanish2_ci"
                                        title="Spanisch (traditionell), Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_spanish2_ci
                                </option>
                                <option value="utf32_spanish_ci"
                                        title="Spanisch (modern), Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_spanish_ci
                                </option>
                                <option value="utf32_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">utf32_swedish_ci
                                </option>
                                <option value="utf32_thai_520_w2" title="Thai (UCA 5.2.0), mehrschichtig">
                                    utf32_thai_520_w2
                                </option>
                                <option value="utf32_turkish_ci"
                                        title="Türkisch, Beachtet nicht Groß- und Kleinschreibung">utf32_turkish_ci
                                </option>
                                <option value="utf32_unicode_520_ci"
                                        title="Unicode (UCA 5.2.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_unicode_520_ci
                                </option>
                                <option value="utf32_unicode_520_nopad_ci"
                                        title="Unicode (UCA 5.2.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_unicode_520_nopad_ci
                                </option>
                                <option value="utf32_unicode_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf32_unicode_ci
                                </option>
                                <option value="utf32_unicode_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_unicode_nopad_ci
                                </option>
                                <option value="utf32_vietnamese_ci"
                                        title="Vietnamesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    utf32_vietnamese_ci
                                </option>
                            </optgroup>
                            <optgroup label="utf8" title="UTF-8 Unicode">
                                <option value="utf8_bin" title="Unicode, Binär">utf8_bin</option>
                                <option value="utf8_croatian_ci"
                                        title="Kroatisch, Beachtet nicht Groß- und Kleinschreibung">utf8_croatian_ci
                                </option>
                                <option value="utf8_croatian_mysql561_ci"
                                        title="Kroatisch (MySQL 5.6.1), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_croatian_mysql561_ci
                                </option>
                                <option value="utf8_czech_ci"
                                        title="Tschechisch, Beachtet nicht Groß- und Kleinschreibung">utf8_czech_ci
                                </option>
                                <option value="utf8_danish_ci"
                                        title="Dänisch, Beachtet nicht Groß- und Kleinschreibung">utf8_danish_ci
                                </option>
                                <option value="utf8_esperanto_ci"
                                        title="Esperanto, Beachtet nicht Groß- und Kleinschreibung">utf8_esperanto_ci
                                </option>
                                <option value="utf8_estonian_ci"
                                        title="Estnisch, Beachtet nicht Groß- und Kleinschreibung">utf8_estonian_ci
                                </option>
                                <option value="utf8_general_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf8_general_ci
                                </option>
                                <option value="utf8_general_mysql500_ci"
                                        title="Unicode (MySQL 5.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_general_mysql500_ci
                                </option>
                                <option value="utf8_general_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_general_nopad_ci
                                </option>
                                <option value="utf8_german2_ci"
                                        title="Deutsch (Telefonbuchverzeichnis), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_german2_ci
                                </option>
                                <option value="utf8_hungarian_ci"
                                        title="Ungarisch, Beachtet nicht Groß- und Kleinschreibung">utf8_hungarian_ci
                                </option>
                                <option value="utf8_icelandic_ci"
                                        title="Isländisch, Beachtet nicht Groß- und Kleinschreibung">utf8_icelandic_ci
                                </option>
                                <option value="utf8_latvian_ci"
                                        title="Lettisch, Beachtet nicht Groß- und Kleinschreibung">utf8_latvian_ci
                                </option>
                                <option value="utf8_lithuanian_ci"
                                        title="Litauisch, Beachtet nicht Groß- und Kleinschreibung">utf8_lithuanian_ci
                                </option>
                                <option value="utf8_myanmar_ci"
                                        title="Birmanisch, Beachtet nicht Groß- und Kleinschreibung">utf8_myanmar_ci
                                </option>
                                <option value="utf8_nopad_bin" title="Unicode, no-pad, Binär">utf8_nopad_bin</option>
                                <option value="utf8_persian_ci"
                                        title="Persisch, Beachtet nicht Groß- und Kleinschreibung">utf8_persian_ci
                                </option>
                                <option value="utf8_polish_ci"
                                        title="Polnisch, Beachtet nicht Groß- und Kleinschreibung">utf8_polish_ci
                                </option>
                                <option value="utf8_roman_ci"
                                        title="Westeuropäisch, Beachtet nicht Groß- und Kleinschreibung">utf8_roman_ci
                                </option>
                                <option value="utf8_romanian_ci"
                                        title="Rumänisch, Beachtet nicht Groß- und Kleinschreibung">utf8_romanian_ci
                                </option>
                                <option value="utf8_sinhala_ci"
                                        title="Singhalesisch, Beachtet nicht Groß- und Kleinschreibung">utf8_sinhala_ci
                                </option>
                                <option value="utf8_slovak_ci"
                                        title="Slovakisch, Beachtet nicht Groß- und Kleinschreibung">utf8_slovak_ci
                                </option>
                                <option value="utf8_slovenian_ci"
                                        title="Slovenisch, Beachtet nicht Groß- und Kleinschreibung">utf8_slovenian_ci
                                </option>
                                <option value="utf8_spanish2_ci"
                                        title="Spanisch (traditionell), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_spanish2_ci
                                </option>
                                <option value="utf8_spanish_ci"
                                        title="Spanisch (modern), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_spanish_ci
                                </option>
                                <option value="utf8_swedish_ci"
                                        title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">utf8_swedish_ci
                                </option>
                                <option value="utf8_thai_520_w2" title="Thai (UCA 5.2.0), mehrschichtig">
                                    utf8_thai_520_w2
                                </option>
                                <option value="utf8_turkish_ci"
                                        title="Türkisch, Beachtet nicht Groß- und Kleinschreibung">utf8_turkish_ci
                                </option>
                                <option value="utf8_unicode_520_ci"
                                        title="Unicode (UCA 5.2.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_unicode_520_ci
                                </option>
                                <option value="utf8_unicode_520_nopad_ci"
                                        title="Unicode (UCA 5.2.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_unicode_520_nopad_ci
                                </option>
                                <option value="utf8_unicode_ci"
                                        title="Unicode, Beachtet nicht Groß- und Kleinschreibung">utf8_unicode_ci
                                </option>
                                <option value="utf8_unicode_nopad_ci"
                                        title="Unicode, no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_unicode_nopad_ci
                                </option>
                                <option value="utf8_vietnamese_ci"
                                        title="Vietnamesisch, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8_vietnamese_ci
                                </option>
                            </optgroup>
                            <optgroup label="utf8mb4" title="UTF-8 Unicode">
                                <option value="utf8mb4_bin" title="Unicode (UCA 4.0.0), Binär">utf8mb4_bin</option>
                                <option value="utf8mb4_croatian_ci"
                                        title="Kroatisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_croatian_ci
                                </option>
                                <option value="utf8mb4_croatian_mysql561_ci"
                                        title="Kroatisch (MySQL 5.6.1), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_croatian_mysql561_ci
                                </option>
                                <option value="utf8mb4_czech_ci"
                                        title="Tschechisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_czech_ci
                                </option>
                                <option value="utf8mb4_danish_ci"
                                        title="Dänisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_danish_ci
                                </option>
                                <option value="utf8mb4_esperanto_ci"
                                        title="Esperanto (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_esperanto_ci
                                </option>
                                <option value="utf8mb4_estonian_ci"
                                        title="Estnisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_estonian_ci
                                </option>
                                <option value="utf8mb4_general_ci"
                                        title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung"
                                        selected="">utf8mb4_general_ci
                                </option>
                                <option value="utf8mb4_general_nopad_ci"
                                        title="Unicode (UCA 4.0.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_general_nopad_ci
                                </option>
                                <option value="utf8mb4_german2_ci"
                                        title="Deutsch (Telefonbuchverzeichnis) (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_german2_ci
                                </option>
                                <option value="utf8mb4_hungarian_ci"
                                        title="Ungarisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_hungarian_ci
                                </option>
                                <option value="utf8mb4_icelandic_ci"
                                        title="Isländisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_icelandic_ci
                                </option>
                                <option value="utf8mb4_latvian_ci"
                                        title="Lettisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_latvian_ci
                                </option>
                                <option value="utf8mb4_lithuanian_ci"
                                        title="Litauisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_lithuanian_ci
                                </option>
                                <option value="utf8mb4_myanmar_ci"
                                        title="Birmanisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_myanmar_ci
                                </option>
                                <option value="utf8mb4_nopad_bin" title="Unicode (UCA 4.0.0), no-pad, Binär">
                                    utf8mb4_nopad_bin
                                </option>
                                <option value="utf8mb4_persian_ci"
                                        title="Persisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_persian_ci
                                </option>
                                <option value="utf8mb4_polish_ci"
                                        title="Polnisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_polish_ci
                                </option>
                                <option value="utf8mb4_roman_ci"
                                        title="Westeuropäisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_roman_ci
                                </option>
                                <option value="utf8mb4_romanian_ci"
                                        title="Rumänisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_romanian_ci
                                </option>
                                <option value="utf8mb4_sinhala_ci"
                                        title="Singhalesisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_sinhala_ci
                                </option>
                                <option value="utf8mb4_slovak_ci"
                                        title="Slovakisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_slovak_ci
                                </option>
                                <option value="utf8mb4_slovenian_ci"
                                        title="Slovenisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_slovenian_ci
                                </option>
                                <option value="utf8mb4_spanish2_ci"
                                        title="Spanisch (traditionell) (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_spanish2_ci
                                </option>
                                <option value="utf8mb4_spanish_ci"
                                        title="Spanisch (modern) (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_spanish_ci
                                </option>
                                <option value="utf8mb4_swedish_ci"
                                        title="Schwedisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_swedish_ci
                                </option>
                                <option value="utf8mb4_thai_520_w2" title="Thai (UCA 5.2.0), mehrschichtig">
                                    utf8mb4_thai_520_w2
                                </option>
                                <option value="utf8mb4_turkish_ci"
                                        title="Türkisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_turkish_ci
                                </option>
                                <option value="utf8mb4_unicode_520_ci"
                                        title="Unicode (UCA 5.2.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_unicode_520_ci
                                </option>
                                <option value="utf8mb4_unicode_520_nopad_ci"
                                        title="Unicode (UCA 5.2.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_unicode_520_nopad_ci
                                </option>
                                <option value="utf8mb4_unicode_ci"
                                        title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_unicode_ci
                                </option>
                                <option value="utf8mb4_unicode_nopad_ci"
                                        title="Unicode (UCA 4.0.0), no-pad, Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_unicode_nopad_ci
                                </option>
                                <option value="utf8mb4_vietnamese_ci"
                                        title="Vietnamesisch (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                    utf8mb4_vietnamese_ci
                                </option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="col-12">
                        <input id="buttonGo" class="btn btn-primary" type="submit" value="Anlegen">
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex flex-wrap my-3">
            <div>
                <div class="input-group">
                    <div class="input-group-text">
                        <div class="form-check mb-0">
                            <input class="form-check-input checkall_box" type="checkbox" value="" id="checkAllCheckbox"
                                   form="dbStatsForm">
                            <label class="form-check-label" for="checkAllCheckbox">Alle auswählen</label>
                        </div>
                    </div>
                    <button class="btn btn-outline-secondary" id="bulkActionDropButton" type="submit" name="submit_mult"
                            value="Drop" form="dbStatsForm" title="Löschen">
                        <span class="text-nowrap"><img src="themes/dot.gif" title="Löschen" alt="Löschen"
                                                       class="icon ic_db_drop">&nbsp;Löschen</span>
                    </button>
                </div>
            </div>

            <div class="ms-auto">
                <div class="input-group">
                    <span class="input-group-text"><img src="themes/dot.gif" title="Suche" alt="Suche"
                                                        class="icon ic_b_search"></span>
                    <input class="form-control" name="filterText" type="text" id="filterText" value=""
                           placeholder="Suche" aria-label="Suche">
                </div>
            </div>
        </div>


        <form class="ajax" action="index.php?route=/server/databases" method="post" name="dbStatsForm" id="dbStatsForm">
            <input type="hidden" name="statistics" value=""><input type="hidden" name="pos" value="0"><input
                    type="hidden" name="sort_by" value="SCHEMA_NAME"><input type="hidden" name="sort_order" value="asc"><input
                    type="hidden" name="token" value="664b4d377a2930443f4b7b2a374d4c27">
            <div class="table-responsive">
                <table class="table table-striped table-hover w-auto">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>
                            <a href="index.php?route=/server/databases&amp;statistics=0&amp;pos=0&amp;sort_by=SCHEMA_NAME&amp;sort_order=desc">
                                Datenbank <img src="themes/dot.gif" title="Aufsteigend" alt="Aufsteigend"
                                               class="icon ic_s_asc">
                            </a>
                        </th>

                        <th>
                            <a href="index.php?route=/server/databases&amp;statistics=0&amp;pos=0&amp;sort_by=DEFAULT_COLLATION_NAME&amp;sort_order=asc">
                                Kollation </a>
                        </th>


                        <th>Aktion</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="db-row" data-filter-row="ANNODOMINI">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="annodomini"
                                   value="annodomini">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=annodomini"
                               title="Springe zu Datenbank 'annodomini'">
                                annodomini
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="annodomini"
                               href="index.php?route=/server/privileges&amp;db=annodomini&amp;checkprivsdb=annodomini"
                               title="Überprüft die Rechte für die Datenbank &quot;annodomini&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="ANNODOMINI_DEV">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="annodomini_dev"
                                   value="annodomini_dev">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=annodomini_dev"
                               title="Springe zu Datenbank 'annodomini_dev'">
                                annodomini_dev
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="annodomini_dev"
                               href="index.php?route=/server/privileges&amp;db=annodomini_dev&amp;checkprivsdb=annodomini_dev"
                               title="Überprüft die Rechte für die Datenbank &quot;annodomini_dev&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="BEWEGTUNTE_CNTND">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="bewegtunte_cntnd"
                                   value="bewegtunte_cntnd">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=bewegtunte_cntnd"
                               title="Springe zu Datenbank 'bewegtunte_cntnd'">
                                bewegtunte_cntnd
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="bewegtunte_cntnd"
                               href="index.php?route=/server/privileges&amp;db=bewegtunte_cntnd&amp;checkprivsdb=bewegtunte_cntnd"
                               title="Überprüft die Rechte für die Datenbank &quot;bewegtunte_cntnd&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="CNTND">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="cntnd" value="cntnd">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=cntnd"
                               title="Springe zu Datenbank 'cntnd'">
                                cntnd
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="cntnd"
                               href="index.php?route=/server/privileges&amp;db=cntnd&amp;checkprivsdb=cntnd"
                               title="Überprüft die Rechte für die Datenbank &quot;cntnd&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="CONTENIDO">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="contenido"
                                   value="contenido">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=contenido"
                               title="Springe zu Datenbank 'contenido'">
                                contenido
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="contenido"
                               href="index.php?route=/server/privileges&amp;db=contenido&amp;checkprivsdb=contenido"
                               title="Überprüft die Rechte für die Datenbank &quot;contenido&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="FOOTBALL-API">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="football-api"
                                   value="football-api">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=football-api"
                               title="Springe zu Datenbank 'football-api'">
                                football-api
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="football-api"
                               href="index.php?route=/server/privileges&amp;db=football-api&amp;checkprivsdb=football-api"
                               title="Überprüft die Rechte für die Datenbank &quot;football-api&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row noclick" data-filter-row="INFORMATION_SCHEMA">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="information_schema"
                                   value="information_schema" disabled="">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=information_schema"
                               title="Springe zu Datenbank 'information_schema'">
                                information_schema
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode, Beachtet nicht Groß- und Kleinschreibung">
                                utf8_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="information_schema"
                               href="index.php?route=/server/privileges&amp;db=information_schema&amp;checkprivsdb=information_schema"
                               title="Überprüft die Rechte für die Datenbank &quot;information_schema&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="LUNCHTIME">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="lunchtime"
                                   value="lunchtime">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=lunchtime"
                               title="Springe zu Datenbank 'lunchtime'">
                                lunchtime
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="lunchtime"
                               href="index.php?route=/server/privileges&amp;db=lunchtime&amp;checkprivsdb=lunchtime"
                               title="Überprüft die Rechte für die Datenbank &quot;lunchtime&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="MITFAHREN">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="mitfahren"
                                   value="mitfahren">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=mitfahren"
                               title="Springe zu Datenbank 'mitfahren'">
                                mitfahren
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="mitfahren"
                               href="index.php?route=/server/privileges&amp;db=mitfahren&amp;checkprivsdb=mitfahren"
                               title="Überprüft die Rechte für die Datenbank &quot;mitfahren&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row noclick" data-filter-row="MYSQL">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="mysql" value="mysql"
                                   disabled="">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=mysql"
                               title="Springe zu Datenbank 'mysql'">
                                mysql
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="mysql"
                               href="index.php?route=/server/privileges&amp;db=mysql&amp;checkprivsdb=mysql"
                               title="Überprüft die Rechte für die Datenbank &quot;mysql&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row noclick" data-filter-row="PERFORMANCE_SCHEMA">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="performance_schema"
                                   value="performance_schema" disabled="">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=performance_schema"
                               title="Springe zu Datenbank 'performance_schema'">
                                performance_schema
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode, Beachtet nicht Groß- und Kleinschreibung">
                                utf8_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="performance_schema"
                               href="index.php?route=/server/privileges&amp;db=performance_schema&amp;checkprivsdb=performance_schema"
                               title="Überprüft die Rechte für die Datenbank &quot;performance_schema&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row noclick" data-filter-row="PHPMYADMIN">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="phpmyadmin"
                                   value="phpmyadmin" disabled="">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=phpmyadmin"
                               title="Springe zu Datenbank 'phpmyadmin'">
                                phpmyadmin
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode, Binär">
                                utf8_bin
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="phpmyadmin"
                               href="index.php?route=/server/privileges&amp;db=phpmyadmin&amp;checkprivsdb=phpmyadmin"
                               title="Überprüft die Rechte für die Datenbank &quot;phpmyadmin&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="PROMO">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="promo" value="promo">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=promo"
                               title="Springe zu Datenbank 'promo'">
                                promo
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Unicode (UCA 4.0.0), Beachtet nicht Groß- und Kleinschreibung">
                                utf8mb4_general_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="promo"
                               href="index.php?route=/server/privileges&amp;db=promo&amp;checkprivsdb=promo"
                               title="Überprüft die Rechte für die Datenbank &quot;promo&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    <tr class="db-row" data-filter-row="TEST">
                        <td class="tool">
                            <input type="checkbox" name="selected_dbs[]" class="checkall" title="test" value="test">
                        </td>

                        <td class="name">
                            <a href="index.php?route=/database/structure&amp;db=test"
                               title="Springe zu Datenbank 'test'">
                                test
                            </a>
                        </td>

                        <td class="value">
                            <dfn title="Schwedisch, Beachtet nicht Groß- und Kleinschreibung">
                                latin1_swedish_ci
                            </dfn>
                        </td>


                        <td class="tool">
                            <a class="server_databases" data="test"
                               href="index.php?route=/server/privileges&amp;db=test&amp;checkprivsdb=test"
                               title="Überprüft die Rechte für die Datenbank &quot;test&quot;.">
                                <span class="text-nowrap"><img src="themes/dot.gif" title="Rechte überprüfen"
                                                               alt="Rechte überprüfen" class="icon ic_s_rights">&nbsp;Rechte überprüfen</span>
                            </a>
                        </td>
                    </tr>
                    </tbody>

                    <tfoot class="table-light">
                    <tr>
                        <th colspan="3">
                            Insgesamt: <span id="filter-rows-count">14</span>
                        </th>


                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </form>

        <div class="card">
            <div class="card-body">
                <div class="alert alert-info" role="alert">
                    <span class="text-nowrap"><img src="themes/dot.gif"
                                                   title="Bitte beachten Sie: Das Aktivieren der Datenbankstatistiken kann starken Traffic zwischen dem Web- und dem MySQL-Server zur Folge haben."
                                                   alt="Bitte beachten Sie: Das Aktivieren der Datenbankstatistiken kann starken Traffic zwischen dem Web- und dem MySQL-Server zur Folge haben."
                                                   class="icon ic_s_notice">&nbsp;Bitte beachten Sie: Das Aktivieren der Datenbankstatistiken kann starken Traffic zwischen dem Web- und dem MySQL-Server zur Folge haben.</span>
                </div>
                <a class="card-link" href="index.php?route=/server/databases" data-post="statistics=1"
                   title="Datenbankstatistiken aktivieren">
                    Datenbankstatistiken aktivieren </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dropDatabaseModal" tabindex="-1" aria-labelledby="dropDatabaseModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dropDatabaseModalLabel">Fortfahren</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Abbrechen"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <button type="button" class="btn btn-danger" id="dropDatabaseModalDropButton">Löschen</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>