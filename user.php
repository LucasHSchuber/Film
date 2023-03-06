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

            <?php
            //instans
            $newuser = new Newuser();
            $username = $_GET['username'];
            //lagrar info från användaren i $info
            $info = $newuser->getUserInfo($username);

            //instans
            $newpost = new Newpost();
            $posts = $newpost->getPostsAmount($username);

            ?>

            <section class="profile">
                <h1><?= $info['username'] ?></h1>
                <h2><?= $info['firstname'] . " " . $info['lastname'] ?></h2>
                <p>Antal inlägg: <?= $posts["COUNT(username)"] ?></p>
                <hr class="hr">
            </section>


            <section class="info-post">

                <?php

            
                if (isset($_GET['username'])) {
                    $username = $_GET['username'];

                    if ($newpost->printPostUser($username)) {
                    }
                }

                $list = $newpost->printPostUser($username);

                foreach ($list as $index => $post) {
                    echo "
                 <div class='box-posts'> 
                    <img class='post-image' src='postsimages/" . $post['filename'] . "' alt='Bild " . $post['id'] . ", uppladdat av " . $post['username'] . "'>
                    <h1 class='post-title'>" . $post['title'] . " <span class='post-span'>(" . $post['year'] . ")</span> </h1> 
                    <p class='post-media'>" . $post['media'] . " &nbsp; &#x2022; &nbsp; " . $post['genre'] . " &nbsp; &#x2022; &nbsp; " . $post['grade'] . "/10 <i class='fa-regular fa-star'></i> </p>
                    <p class='post-username'>" . "<a style='color:white;text-decoration:underline; 'href='user.php?username=" . $post['username'] . "'>" . $post['username'] . "</a>" . "&nbsp; &#x2022; &nbsp; " . $post['created'] . "</p> 
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
</body>

</html>