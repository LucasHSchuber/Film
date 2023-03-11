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
                    <h1 class="title">Skriv in nytt lösenord</h1>

                    <?php

                    //instans
                    $newuser = new Newuser();

                    if (isset($_POST['password']) && isset($_POST['repeatpassword']) && isset($_POST['username'])) {

                        $password = $_POST['password'];
                        $repeatpassword = $_POST['repeatpassword'];
                        $username = $_POST['username'];

                        if ($newuser->changePassword($password, $repeatpassword, $username)) {
                            //if true

                        }
                    }

                    ?>

                    <label for="username">Användarnamn:</label><br>
                    <input class="input-form" type="text" name="username" id="username"><br>
                    <label for='password'>Lösenord: *</label><br>
                    <input class='input-form' type='password' name='password' id='password'><br>
                    <label for='repeatpassword'>Upprepa lösenord: *</label><br>
                    <input class='input-form' type='password' name='repeatpassword' id='repeatpassword'><br><br><br>
                    <button class="login-btn" type="submit">Byt lösenord &nbsp; <i class="fa-solid fa-key"></i></button><br><br>
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