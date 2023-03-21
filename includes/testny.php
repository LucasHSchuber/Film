<nav class="navbar navbar-expand-lg navbar-dark " >
    <a class="logo" href="index.php">Flim</a>
    <button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Hem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="films.php">Filmer</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="series.php">Serier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="documenteries.php">Dokumentärer</a>
            </li>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" style="padding-right:0.5em;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Meny
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="user.php">Min profil</a>
                    <a class="dropdown-item" href="myposts.php">Mina inlägg</a>
                    <a class="dropdown-item" href="settings.php">Inställningar</a>
                    <a class="dropdown-item" href="topusers.php">Topplista</a>
                   <hr class="hr-navbar" style="margin-top:0.5em;">
                    <a class="dropdown-item" href="logout.php">Logga ut från Flim</a>
                    <hr class="hr-navbar-res">
                </div>
            </div>
            <li class="nav-item">
                <a class="nav-link square" href="createpost.php "> &nbsp;<i class="fa-regular fa-1x fa-square-plus"></i></a>
            </li>
            
        </ul>
    </div>
</nav>