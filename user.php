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
            $info = $newuser->getUserInfo($username);

            //instans
            $newpost = new Newpost();
            $posts = $newpost->getPostsAmount($username);

            // echo "<pre>";
            // print_r($info); // or var_dump($data);
            // echo "</pre>";

            //hämtar ett click på profilen
            if (isset($_GET['username'])) {
                $username = $_GET['username'];

                if ($newuser->addClick($username)) {
                }
            }

            ?>

            <section class="profile-wrapper">
                <div>
                    <h1><?= $info['username'] ?></h1>
                    <?php
                    echo "<img class='profile-picture' src='profileimages/" . $info['filename'] . "' >";
                    ?>
                </div>
                <div class="profile-info">
                    <h2><span>Namn: </span><?= $info['firstname'] . " " . $info['lastname'] ?></h2>
                    <h2 style="margin-bottom:1em;"><span>Antal inlägg:</span> <?= $posts['COUNT(username)'] ?></h2>
                    <p><span>Biografi: </span> <?= $info['bio'] ?></p>
                </div>

            </section>
            <hr class="hr">


            <section class="">

                <h1 class="title" style="width: 80%;max-width: 100em;margin: auto;margin-bottom:2em;"><?= $info['username'] ?>'s alla inlägg:</h1>

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
                    <p class='post-media'>" . $post['media'] . " &nbsp; &#x2022; &nbsp; " . $post['genre'] . " &nbsp; &#x2022; &nbsp; " . $post['grade'] . "/10 <img src='images/symbols/star.png' width='18px' height='18px' style='margin-bottom:0.3em;'> </p>
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