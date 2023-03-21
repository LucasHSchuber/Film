<nav class="navbar navbar-expand-lg navbar-dark">
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
            <div class="vl"></div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" style="padding-right:0.5em;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>Meny</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="myprofile.php">Min profil</a>
                    <a class="dropdown-item" href="myposts.php">Hantera inlägg</a>
                    <a class="dropdown-item" href="settings.php">Inställningar</a>
                    <a class="dropdown-item" href="topusers.php">Topplista</a>
                   <hr class="hr-navbar" style="margin-top:0.5em;">
                    <a class="dropdown-item" href="logout.php">Logga ut från Flim</a>
                    <hr class="hr-navbar-res">
                </div>
            </div>
            <li class="nav-item">
                <a class="nav-link square" href="createpost.php "> Nytt inlägg &nbsp;<i class="fa-solid fa-plus"></i></a>
            </li>
            
        </ul>
    </div>
</nav>