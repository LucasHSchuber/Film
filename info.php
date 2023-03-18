<?php
include("includes/config.php");
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <title>info</title>

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
            include("includes/nav.php");
        }

        ?>
    </header>
    <main>

        <div class="wrapper">

            <section class="info-post">

                <?php

                $newpost = new Newpost();


                //hämtar ett click på profilen
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    if ($newpost->addRead($id)) {
                    }
                }


                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    if ($newpost->printPostSpec($id)) {
                    }
                }


                $list = $newpost->printPostSpec($id);

                foreach ($list as $post) {
                    echo "
                    <div class='box-posts'> 
                    <img class='post-image' src='postsimages/" . $post['filename'] . "' alt='Bild " . $post['id'] . ", uppladdat av " . $post['username'] . "'>
                    <h1 class='post-title'>" . $post['title'] . " <span class='post-span'>(" . $post['year'] . ")</span> </h1> 
                    <p class='post-media'>" . $post['media'] . " &nbsp; &#x2022; &nbsp; " . $post['genre'] . " &nbsp; &#x2022; &nbsp; " . $post['grade'] . "/10 <img src='images/symbols/star.png' width='18px' height='18px' style='margin-bottom:0.3em;'> </p>
                    <p class='post-username'>" . "<a class='link' style='color:white;text-decoration:underline; 'href='user.php?username=" . $post['username'] . "'>" . $post['username'] . "</a>" . "&nbsp; &#x2022; &nbsp; " . $post['created'] . "</p> 
                    <p class='post-comment'>" . $post['comment'] . "</p> 
                    <a class='post-btn read-btn' href='index.php'>Tillbaka</a>
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