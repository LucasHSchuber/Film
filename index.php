<?php
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Index</title>

    <?php
    include("includes/head.php");
    ?>

</head>

<body>
    <header>
        <?php

        if (isset($_SESSION['username'])) {
            include("includes/nav_loggedin.php");
        } else {
            include("includes/testny.php");
        }

        ?>
    </header>
    <main>

        <div class="hero-wrapper">
            <picture class="hero-image">
                <source srcset="images/index_mellan.jpg" media="(min-width: 1521px)">
                <source srcset="images/index_mellan.jpg" media="(min-width: 801px)">
                <img src="images/index_small.jpg" alt="index, hero" >
            </picture>
        </div>

        <div class="wrapper">

            <section class="box-one">
                <p class="grid-box-one">flim &#x2022; blog.</p>
                <h1 class="grid-box-one">Filmer. Serier. Dokumentärer. <br> Tips. Titta. Tipsa.</h1>
                <ol class="grid-box-one" style="list-style-type:none;">
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

                //checks if post is created and then echo message
                if (isset($_SESSION['postcreated'])) {
                    echo "<p class='success message'" . "<i class='fa-solid fa-check'></i>" . "&nbsp;" . $_SESSION['postcreated'] . "</p>";
                }
                unset($_SESSION['postcreated']);


                $num = (int)5;
                $list = $newpost->printPostsAll($num);

                foreach ($list as $index => $post) {
                    echo "
                <div class='box-posts'> 
                    <img class='post-image' src='postsimages/" . $post['filename'] . "' alt='Bild " . $post['id'] . ", uppladdat av " . $post['username'] . "'>
                    <h1 class='post-title'>" . $post['title'] . " <span class='post-span'>(" . $post['year'] . ")</span> </h1> 
                    <p class='post-media'>" . $post['media'] . " &nbsp; &#x2022; &nbsp; " . $post['genre'] . " &nbsp; &#x2022; &nbsp; " . $post['grade'] . "/10" . "<img src='images/symbols/star.png' alt='betyg, bild " . $post['id'] . "' width='18' height='18' style='margin-bottom:0.3em;'>" . "</p>
                    <p class='post-username'>" . "<a class='link' style='color:white;text-decoration:underline;' href='user.php?username=" . $post['username'] . "'>" . $post['username'] . "</a>" . "&nbsp; &#x2022; &nbsp; " . $post['created'] . "</p> 
                    <p class='post-comment'>" . $post['comment'] . "</p> 
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


    <script src=js/js.js></script>
</body>

</html>