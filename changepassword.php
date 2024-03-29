<?php
include("includes/config.php");
?>
<?php
if (!isset($_SESSION['changepassword'])) {
    header("location: forgotpassword.php?message=Du måste fylla i denna sida först!");
}
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
            include("includes/navbar_loggedin.php");
        } else {
            include("includes/navbar.php");
        }        ?>
    </header>
    <main>

        <div class="">

            <section class="login-wrapper container">

                <form method="POST" class="form">
                    <h1 class="title">Skriv in nytt lösenord</h1>

                    <?php



                    //instans
                    $newuser = new Newuser();


                    if (isset($_POST['password'])) {

                        $password = $_POST['password'];
                        $repeatpassword = $_POST['repeatpassword'];
                        $email = $_SESSION['changepassword'];

                        $succes = true; // if all posts are OK

                        if (!$newuser->setPassword($repeatpassword, $password)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange lösenord som är minst 4 tecken långt, och som innehåller siffror och bokstäver!</p>";
                        }
                        if (!$newuser->repeatPassword($repeatpassword, $password)) {
                            $succes = false;
                            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Lösenorden matchar inte!</p>";
                        }

                        if ($newuser->changePassword($password, $repeatpassword, $email)) {
                            //if true
                            unset($_SESSION['changepassword']);
                        }
                    }


                    ?>


                    <label for='password'>Lösenord: *</label><br>
                    <input class='input-form' type='password' name='password' id='password'><br>
                    <label for='repeatpassword'>Upprepa lösenord: *</label><br>
                    <input class='input-form' type='password' name='repeatpassword' id='repeatpassword'><br><br><br>
                    <button class="login-btn" type="submit">Byt lösenord &nbsp; <i class="fa-solid fa-key"></i></button><br><br>
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