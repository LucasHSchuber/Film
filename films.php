<?php
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Filmer</title>

    <?php
    include("includes/head.php");
    ?>

</head>

<body>
    <header>
        <?php
        if (isset($_SESSION['username'])) {
            include("includes/navbar_loggedin.php");
        } else {
            include("includes/navbar.php");
        }        ?>
    </header>
    <main>

        <div class="hero-wrapper">
            <picture class="hero-image">
                <source srcset="images/filmer_mellan.jpg" media="(min-width: 1521px)">
                <source srcset="images/filmer_mellan.jpg" media="(min-width: 801px)">
                <img src="images/filmer_small.jpg" alt="filmer, hero" />
            </picture>
        </div>

        <div class="wrapper">

            <section class="box-films">
                <p class="grid-box-films">flim &#x2022; blog.</p>
                <h1 class="grid-box-films">Filmer.</h1>
                <div class="grid-box-films">
                    <select class="select-genre">
                        <option value="Genre">Genre (not working) </option>
                        <option value="Action">Action</option>
                        <option value="Drama">Drama</option>
                        <option value="Historia">Historia</option>
                        <option value="Hjärnskrynklare">Hjärnskrynklare</option>
                        <option value="Komedi">Komedi</option>
                        <option value="Romantik">Romantik</option>
                        <option value="Skräck">Skräck</option>
                        <option value="Thriller">Thriller</option>
                    </select>
                </div>
                <ol class="grid-box-films" style="list-style-type:none;">
                    <a style='font-size:1.4em !important;'>Profiler:</a>
                    <?php
                    $newpost = new Newpost();

                    $blogs = $newpost->printUsers();

                    foreach ($blogs as $users) {
                        echo "<li > <a class='link' style='text-decoration:underline;' href='user.php?username=" . $users['username'] .  "'>" . $users['username'] . "</a></li>";
                    }
                    ?>
                </ol>
            </section>


            <section>

                <?php


                $newpost = new Newpost();
                $list = $newpost->printPostsFilms();

                foreach ($list as $index => $post) {
                    if(strlen($post['comment']) > 175){
                        $comment = substr($post['comment'], 0, 175) . "...";
                        }else{
                         $comment = $post['comment'];
                        }
                    echo "
                    <div class='box-posts'> 
                    <img class='post-image' src='postsimages/" . $post['filename'] . "' alt='Bild " . $post['id'] . ", uppladdat av " . $post['username'] . "'>
                    <h1 class='post-title'>" . $post['title'] . " <span class='post-span'>(" . $post['year'] . ")</span> </h1> 
                    <p class='post-media'>" . $post['media'] . " &nbsp; &#x2022; &nbsp; " . $post['genre'] . " &nbsp; &#x2022; &nbsp; " . $post['grade'] . "/10 <img src='images/symbols/star.png' alt='stjärna, betyg' width='18' height='18' style='margin-bottom:0.3em;'> </p>
                    <p class='post-username'>" . "<a style='color:white;text-decoration:underline;' href='user.php?username=" . $post['username'] . "'>" . $post['username'] . "</a>" . "&nbsp; &#x2022; &nbsp; " . $post['created'] . "</p> 
                    <p class='post-comment'>" . $comment . "</p> 
                    <a class='post-btn read-btn' href='info.php?id=" . $post['id'] . "'>Läs mer</a>
                </div>";
                }
                ?>


            </section>


        </div>
    </main>

    <footer>
        <?php
        include("includes/footer.php");
        ?>
    </footer>
</body>

</html>