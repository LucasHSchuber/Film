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
    <title>Settings</title>

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

        <div class="createpost-wrapper container">

            <form method="POST" class="form-createpost" enctype="multipart/form-data">
                <h1 class="title">Kontoinställningar</h1>

                <?php

                //check is session variable is set
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                }

                //checks if settings is update and then echo message
                if (isset($_SESSION['settingsupdate'])) {
                    echo "<p class='success message'>" . "<i class='fa-solid fa-check'></i>" . "&nbsp;" . $_SESSION['settingsupdate'] . "</p>";
                }
                unset($_SESSION['settingsupdate']);

                //instans
                $newuser = new Newuser();

                $info = $newuser->getUserInfo($username);

                // echo "<pre>";
                // print_r($info); // or var_dump($data);
                // echo "</pre>";



                if (isset($_POST['firstname'])) {


                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $bio = strip_tags($_POST['bio']);
                    $file = $_FILES['file'];
                    $id = $info['id'];
                    $fileold = $info['filename'];

                    $succes = true; // if all posts are OK

                    if (!$newuser->setFirstname($firstname)) {
                        $succes = false;
                        echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange ditt förnamn!</p>";
                    }

                    if (!$newuser->setLastname($lastname)) {
                        $succes = false;
                        echo "<p class='error message'> <i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du behöver ange ditt efternamn!</p>";
                    }
                    if (!$newuser->setBio($bio)) {
                        $succes = false;
                        echo "<p class='error message'> <i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Biografin får max innehålla 200 teceken!</p>";
                    }



                    if ($newuser->addUserInfo($firstname, $lastname, $bio, $file, $id, $fileold)) {
                        //if true
                    }
                }

                ?>
                <h3 class="subtitle">Profilinformation</h3>
                <label for="username">Användarnamn: *</label><br>
                <input class="input-form" type="text" name="username" id="username" disabled value="<?= $info['username']; ?>"><br>
                <label for="firstname">Förnamn: *</label><br>
                <input class="input-form" type="text" name="firstname" id="firstname" value="<?= $info['firstname']; ?>"><br>
                <label for="lastname">Efternamn: *</label><br>
                <input class="input-form" type="text" name="lastname" id="lastname" value="<?= $info['lastname']; ?>"><br>
                <label for="email">Email: *</label><br>
                <input class="input-form" type="text" name="email" id="email" disabled value="<?= $info['email']; ?>"><br>
                <label for="bio">Biografi (max 200 tecken): </label><br>
                <textarea class="input-form" name="bio" id="bio" rows="5" style="padding:0.5em!important;"><?= $info['bio']; ?></textarea>
                <label for="file" style="color:white !important;">Profilbild:</label>
                <input class="input-form" style="color:white !important;" type="file" name="file" id="file"><br><br>
                <hr class="hr">
                <h3 class="subtitle">Säkerhet</h3>
                <label for="memory">Namnet på ditt första husdjur (för återställning av lösenord):</label><br>
                <input class="input-form" type="password" name="memory" id="memory" disabled value="<?= $info['memory']; ?>"><br>
                <label for="password">Lösenord: *</label><br>
                <input class="input-form" type="password" name="password" id="password" disabled value="<?= $info['password']; ?>"><br>
                <label for="repeatpassword">Upprepa lösenord: *</label><br>
                <input class="input-form" type="password" name="repeatpassword" id="repeatpassword" disabled value="<?= $info['password']; ?>"><br><br><br><br>
                <button class="login-btn" type="submit">Spara  &nbsp;<i class="fa-solid fa-check"></i></button><br><br>
            </form>




            <section class="">



                <?php



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