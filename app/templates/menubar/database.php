<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-label="Navigation umschalten" aria-controls="navbarNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="width: auto; overflow: visible;">
        <ul id="topmenu" class="navbar-nav">
            <li class="nav-item <?= ($_GET["route"] == "/database/list") ? "active" : "" ?>">
                <a class="nav-link text-nowrap"
                   href="index.php?route=/database/list&amp;db=<?= $_GET["db"] ?>&amp;pos=0">
                    <img src="themes/dot.gif" title="Anzeigen" alt="Anzeigen" class="icon ic_b_browse">&nbsp;Anzeigen
                    <?php if ($_GET["route"] == "/database/list") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/structure") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/structure&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Struktur" alt="Struktur" class="icon ic_b_props">&nbsp;Struktur
                    <?php if ($_GET["route"] == "/database/structure") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/sql") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/sql&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="SQL" alt="SQL" class="icon ic_b_sql">&nbsp;SQL
                    <?php if ($_GET["route"] == "/database/sql") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/search") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/search&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Suche" alt="Suche" class="icon ic_b_search">&nbsp;Suche
                    <?php if ($_GET["route"] == "/database/search") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/change") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/change&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Einfügen" alt="Einfügen" class="icon ic_b_insrow">&nbsp;Einfügen
                    <?php if ($_GET["route"] == "/database/change") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/export") ? "active" : "" ?>">
                <a class="nav-link text-nowrap"
                   href="index.php?route=/database/export&amp;db=<?= $_GET["db"] ?>&amp;single_table=true">
                    <img src="themes/dot.gif" title="Exportieren" alt="Exportieren" class="icon ic_b_tblexport">&nbsp;Exportieren
                    <?php if ($_GET["route"] == "/database/export") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/import") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/import&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Importieren" alt="Importieren" class="icon ic_b_tblimport">&nbsp;Importieren
                    <?php if ($_GET["route"] == "/database/import") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/history" || $_GET["route"] == "/database/history/list") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/history&db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="History" alt="History" class="icon ic_b_group">&nbsp;History
                    <?php if ($_GET["route"] == "/database/history") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($_GET["route"] == "/database/configuration") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/database/configuration&db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Konfiguration" alt="Konfiguration" class="icon ic_b_tblops">&nbsp;Konfiguration
                    <?php if ($_GET["route"] == "/database/configuration") {
                    echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
        </ul>
    </div>
</nav>