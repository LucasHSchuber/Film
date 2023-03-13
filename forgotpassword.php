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

                    //om användaren inte har fyllt i forgotpassweord.php men försöker nå sidan visas den felmeddelandet
                    if (isset($_GET['message'])) {
                        echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du måste fylla i denna sida först! </p>";
                    }

                    //instans
                    $newuser = new Newuser();

                    //default values
                    $email = "";

                    if (isset($_POST['email']) && isset($_POST['memory'])) {

                        $email = $_POST['email'];
                        $memory = strtolower($_POST['memory']);

                        $succes = true; // if all posts are OK
                        

                        if (!$newuser->setEmailMemoryPassword($email, $memory)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver skriva in din email och namnet på ditt första husdjur!</p>";
                        }

                        if ($newuser->getPassword($email, $memory)) {
                            //if true

                            //default values
                            $email = "";
                        }
                    }

                    ?>

                    <label for="email">Email: *</label><br>
                    <input class="input-form" type="text" name="email" id="email" value="<?= $email; ?>"><br>
                    <label for="memory">Namnet på ditt första husdjur: *</label><br>
                    <input class="input-form" type="text" name="memory" id="memory"><br><br><br>
                    <button class="login-btn" type="submit">Matchar det? &nbsp; <i class="fa-solid fa-key"></i></button><br><br>
                    <p class="message">Har du redan ett konto? <a href="login.php" style="text-decoration:underline;">Logga in här.</a><br>
                    <p class="message">Har du inget konto? <a href="createaccount.php" style="text-decoration:underline;">Skapa ett nytt konto här.</a><br>
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