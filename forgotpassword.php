<?php
include("includes/config.php");
?>

<!DOCTYPE html>
<html lang="sv">



<head>
    <title>login</title>

    <?php
    include("includes/head.php");
    ?>
</head>

<body>

    <header>
        <?php

        if (isset($_SESSION['username'])) {
            header("location: index.php");
        } else {
            include("includes/nav.php");
        }
        ?>
    </header>
    <main>

        <div class="">

            <section class="login-wrapper container">

                <form method="POST" class="form">
                    <h1 class="title">Byt lösenord</h1>

                    <?php

                    //instans
                    $newuser = new Newuser();

                    if (isset($_POST['username']) && isset($_POST['memory'])) {

                        $username = $_POST['username'];
                        $memory = strtolower($_POST['memory']);

                        if ($newuser->getPassword($username, $memory)) {
                            //if true
                            $test = $username;
                        }
                    }

                    ?>

                    <label for="username">Användarnamn:</label><br>
                    <input class="input-form" type="text" name="username" id="username"><br>
                    <label for="password">Namnet på ditt första husdjur:</label><br>
                    <input class="input-form" type="text" name="memory" id="memory"><br><br><br>
                    <button class="login-btn" type="submit">Matchar det? &nbsp; <i class="fa-solid fa-key"></i></button><br><br>
                    <p class="message">Har du redan ett konto? <a href="login.php" style="text-decoration:underline;">Logga in här.</a><br>
                    <p class="message">Har du inget konto? <a href="createaccount.php">Skapa ett nytt konto här.</a><br>
                </form>
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