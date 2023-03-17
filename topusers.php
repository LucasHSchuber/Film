<?php
include("includes/config.php");
?>
<?php
if (!isset($_SESSION['username'])) {
    header("location: login.php?message=Du måste vara inloggad för att få åtkomst till denna sida.");
}
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
            include("includes/nav_loggedin.php");
        } else {
            include("includes/nav.php");
        }

        ?>
    </header>
    <main>

        <div class="wrapper">
            
        <h1 class="title" style="margin:auto;width:80%;margin-bottom:1em;">Topplista</h1>
            <section class="toplist">
                
                <table id="customers">
                    <tr>
                        <th>Användarnamn</th>
                        <th>Antal besökare</th>
                    </tr>
                
                    <?php

                    $newuser = new Newuser();

                    $user = $newuser->getTopUsers();

                    foreach ($user as $list) {
                        echo "
                    <tr class=''>
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