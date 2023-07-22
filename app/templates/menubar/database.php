<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Navigation umschalten" aria-controls="navbarNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="width: auto; overflow: visible;">
        <ul id="topmenu" class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link text-nowrap" href="index.php?route=/database/list&amp;db=<?= $_GET["db"] ?>&amp;pos=0">
                    <img src="themes/dot.gif" title="Anzeigen" alt="Anzeigen" class="icon ic_b_browse">&nbsp;Anzeigen
                    <span class="visually-hidden">(aktuelle)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/structure&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Struktur" alt="Struktur" class="icon ic_b_props">&nbsp;Struktur
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/sql&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="SQL" alt="SQL" class="icon ic_b_sql">&nbsp;SQL
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/search&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Suche" alt="Suche" class="icon ic_b_search">&nbsp;Suche
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/change&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Einfügen" alt="Einfügen" class="icon ic_b_insrow">&nbsp;Einfügen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/export&amp;db=<?= $_GET["db"] ?>&amp;single_table=true">
                    <img src="themes/dot.gif" title="Exportieren" alt="Exportieren" class="icon ic_b_tblexport">&nbsp;Exportieren
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/import&amp;db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Importieren" alt="Importieren" class="icon ic_b_tblimport">&nbsp;Importieren
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-nowrap" href="index.php?route=/database/configuration&db=<?= $_GET["db"] ?>">
                    <img src="themes/dot.gif" title="Konfiguration" alt="Konfiguration" class="icon ic_b_tblops">&nbsp;Konfiguration
                </a>
            </li>
        </ul>
    </div>
</nav>