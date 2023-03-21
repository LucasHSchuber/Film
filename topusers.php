<?php
include("includes/config.php");
?>

<!DOCTYPE html>
<html lang="sv">

<head>
    <title>Topusers</title>

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

        <div class="wrapper">

            <h1 class="title" style="margin:auto;width:80%;margin-bottom:1em;">Topplista</h1>
            <section class="toplist">

                <div class="tab">
                    <button class="tablinks" id="visits-btn" onclick="openCity(event, 'visits')">Antal besök</button>
                    <button class="tablinks" onclick="openCity(event, 'posts')">Antal inlägg</button>
                </div>

                <!-- 
                <div class="toplist-btn-wrapper">
                    <button id="visit-info-btn" class="toplist-btn visit" onclick="openVisits()">Antal besök</button>
                    <button id="posts-info-btn" class="toplist-btn posts" onclick="openPosts()">Antal inlägg</button>
                </div> -->

                <table id="visits" class="tabcontent visit-info-box">

                    <tr>
                        <th>Användarnamn</th>
                        <th>Antal besök</th>
                    </tr>

                    <?php

                    $newuser = new Newuser();

                    $num = 10;
                    $user = $newuser->getTopUsers($num);

                    foreach ($user as $list) {
                        echo "
                    <tr>
                        <td>
                        <a href='user.php?username=" . $list['username'] . "'>"
                            . $list['username'] .
                            "</a>  
                        </td>
                        <td>"
                            . $list['click'] .
                            "</td> 
                    </tr>";
                    }

                    // echo "<pre>";
                    // print_r($user); // or var_dump($data);
                    // echo "</pre>";
                    ?>

                </table>

                <table id="posts" class="tabcontent posts-info-box">

                    <tr>
                        <th>Uppladdat av</th>
                        <th>Titel på inlägg</th>
                        <th>Inlägg läst antal gånger</th>
                    </tr>

                    <?php

                    $newposts = new Newpost();

                    $num = 10;
                    $posts = $newposts->getTopRead($num);

                    // echo "<pre>";
                    // print_r($posts); // or var_dump($data);
                    // echo "</pre>";


                    foreach ($posts as $list) {
                        echo "
                    <tr>
                        <td>
                        <a href='user.php?username=" . $list['username'] . "'>"
                            . $list['username'] .
                            "</a>  
                        </td>
                        <td>
                        <a href='info.php?id=" . $list['id'] . "'>"
                            . $list['title'] .
                            "</a>  
                        </td> 
                        <td>"
                            .  $list['click'] .
                            "</td> 
                    </tr>";
                    }

                    // echo "<pre>";
                    // print_r($user); // or var_dump($data);
                    // echo "</pre>";
                    ?>

                </table>
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