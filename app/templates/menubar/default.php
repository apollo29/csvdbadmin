<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-label="Navigation umschalten" aria-controls="navbarNav" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="width: auto; overflow: visible;">
        <ul id="topmenu" class="navbar-nav">
            <li class="nav-item <?= ($route == "/server/databases") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/server/databases">
                    <img src="themes/dot.gif" title="Datenbanken" alt="Datenbanken"
                         class="icon ic_s_db">&nbsp;Datenbanken
                    <?php if ($route == "/server/databases") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($route == "/server/sql") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/server/sql">
                    <img src="themes/dot.gif" title="SQL" alt="SQL" class="icon ic_b_sql">&nbsp;SQL
                    <?php if ($route == "/server/sql") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($route == "/server/export") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/server/export">
                    <img src="themes/dot.gif" title="Exportieren" alt="Exportieren"
                         class="icon ic_b_export">&nbsp;Exportieren
                    <?php if ($route == "/server/export") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
            <li class="nav-item <?= ($route == "/server/import") ? "active" : "" ?>">
                <a class="nav-link text-nowrap" href="index.php?route=/server/import">
                    <img src="themes/dot.gif" title="Importieren" alt="Importieren"
                         class="icon ic_b_import">&nbsp;Importieren
                    <?php if ($route == "/server/import") {
                        echo '<span class="visually-hidden">(aktuelle)</span>';
                    } ?>
                </a>
            </li>
        </ul>
    </div>
</nav>