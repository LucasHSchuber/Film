<?php


class Newuser
{

    //properties
    private $db;
    private $firstname;
    private $lastname;
    private $email;
    private $username;
    private $password;
    private $repeatpassword;
    private $memory;
    private $bio;
    private $fileprofilepic;

    //constructor
    function __construct()
    {
        // $this->db = new mysqli('localhost', 'root', 'root', 'blogsdb');
        $this->db = new mysqli('studentmysql.miun.se', 'luha2200', 'jordenrunt', 'luha2200');
        if ($this->db->connect_errno > 0) {
            die('fel vid anslutning: ' . $this->db->connect_error);
        }
    }

    //add user
    public function addUser(string $firstname, string $lastname, string $email, string $username, string $password, string $memory, string $repeatpassword): bool
    {

        if (!$this->setFirstname($firstname)) return false;
        if (!$this->setLastname($lastname)) return false;
        if (!$this->validEmail($email)) return false;
        if (!$this->emailTaken($email)) return false;
        // if (!$this->setEmail($email)) return false;
        if (!$this->setUsername($username)) return false;
        if (!$this->setPassword($password)) return false;
        if (!$this->repeatPassword($repeatpassword, $password)) return false;

        $sql = "SELECT username FROM users WHERE username='$username';";
        $result = $this->db->query($sql);

        //sanitera med read_escape_string
        $username = $this->db->real_escape_string($username);
        $password =  $this->db->real_escape_string($password);
        $repeatpassword =  $this->db->real_escape_string($repeatpassword);
        $email =  $this->db->real_escape_string($email);
        $firstname =  $this->db->real_escape_string($firstname);
        $lastname =  $this->db->real_escape_string($lastname);
        $memory =  $this->db->real_escape_string($memory);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);


        if ($result->num_rows > 0) {
            echo "<p class='message error'> Användarnamnet är redan upptaget! </p>";
            return false;
        } else {
            $sql = "INSERT INTO users(username, password, firstname, lastname, email, memory)VALUES('$username', '$hashed_password', '$firstname', '$lastname', '$email', '$memory');";
            header("location: login.php");
            $_SESSION['accountcreated'] = "Ditt konto har skapats";
            return $this->db->query($sql);
        }
    }





    // match memory for change of password
    public function getPassword($email, $memory): bool
    {

        if (!$this->setEmailMemoryPassword($email, $memory)) return false;


        $sql = "SELECT email, memory FROM users WHERE email='$email';";
        $result = $this->db->query($sql);
        $info = mysqli_fetch_assoc($result); //returnerar endast en rad istället för en hel array

        if ($info['email'] == $email && $info['memory'] == $memory) {
            $_SESSION['changepassword'] = $email;
            header("location:changepassword.php");
            return true;
        } else {
            echo "<p class='message error'> <i class='fa-solid fa-triangle-exclamation'></i> &nbsp; E-postadressen matchar inte med namnet på husdjuret! </p>";
            return false;
        }
    }



    // match memory for change of password
    public function changePassword($password, $repeatpassword, $email): bool
    {

        if (!$this->setPassword($repeatpassword, $password)) return false;
        if (!$this->repeatPassword($repeatpassword, $password)) return false;

        $password =  $this->db->real_escape_string($password);
        $repeatpassword =  $this->db->real_escape_string($repeatpassword);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['changepassword'];

        if ($password == $repeatpassword) {
            $sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email';";
            $this->db->query($sql);
            header("location: login.php");
            $_SESSION['passwordchanged'] = "Ditt lösenord har ändrats!";
        } else {
            return false;
        }
    }




    public function setFirstname(string $firstname): bool
    {
        if ($firstname != "") {
            $this->firstname = $firstname;
            return true;
        } else {
            return false;
        }
    }
    public function setLastname(string $lastname): bool
    {
        if (($lastname) != "") {
            $this->lastname = $lastname;
            return true;
        } else {
            return false;
        }
    }

    public function emailTaken(string $email): bool
    {
        $sql = "SELECT email FROM users WHERE email='$email';";
        $result = $this->db->query($sql);

        if ($result->num_rows < 1) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }

    public function validEmail(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }
    // public function setEmail(string $email): bool
    // {
    //     if (($email) != "") {
    //         $this->email = $email;
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function setUsername(string $username): bool
    {
        if (($username) != "") {
            $this->username = $username;
            return true;
        } else {
            return false;
        }
    }
    public function setPassword(string $password): bool
    {
        if (strlen($password) > 4 && preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password)) {
            $this->password = $password;
            return true;
        } else {
            return false;
        }
    }
    public function repeatPassword(string $repeatpassword, string $password): bool
    {
        if ($repeatpassword != $password) {
            return false;
        } else {
            $this->repeatpassword = $repeatpassword;
            return true;
        }
    }
    public function setEmailMemoryPassword($email, $memory): bool
    {
        if ($email != "" || $memory != "") {
            $this->username = $email;
            $this->memory = $memory;
            return true;
        } else {
            return false;
        }
    }
    public function setBio(string $bio): bool
    {
        if (strlen($bio) < 200) {
            $this->bio = $bio;
            return true;
        } else {
            return false;
        }
    }









    //login user
    public function getUser(string $username, string $password): bool
    {
        $sql = "SELECT * FROM users WHERE username='$username';";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) { // om den här returnerar sant
                $_SESSION['username'] = $username;
                header("location: index.php");
            } else {
                echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du har skrivit in fel lösenord.</p>";
                return false;
            }
        } else {
            echo "<p class='error message'><i class='fa-solid fa-triangle-exclamation'></i> &nbsp; Du har skrivit in fel användarnamn eller lösenord.</p>";
            return false;
        }
    }

    //login user
    public function getUserInfo(string $username)
    {
        $sql = "SELECT * FROM users WHERE username='$username';";
        $result = $this->db->query($sql);
        return mysqli_fetch_assoc($result); //returnerar endast en rad istället för en hel array

    }




    public function addUserInfo(string $firstname, string $lastname, string $bio, $file, $id, $fileold): bool
    {

        if (!$this->setFirstname($firstname)) return false;
        if (!$this->setLastname($lastname)) return false;
        if (!$this->setBio($bio)) return false;


        if ((isset($_FILES['file'])) && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/jpg")) {

            //flyttar filen till rätt katalog
            move_uploaded_file($_FILES['file']['tmp_name'], "profileimages/" . $_FILES['file']['name']);
            $file = $_FILES['file']['name'];

            //sanitera med read_escape_string
            $firstname =  $this->db->real_escape_string($firstname);
            $lastname =  $this->db->real_escape_string($lastname);
            $bio = $this->db->real_escape_string($bio);


            //SQL fråga
            $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', bio = '$bio', filename = '$file' WHERE id = '$id';";
            $this->db->query($sql);
            $_SESSION['settingsupdate'] = "Dina inställningar har uppdaterats!";
            header("location: settings.php");
            return true;
        } else {

            $file = $fileold;

            //sanitera med read_escape_string
            $firstname =  $this->db->real_escape_string($firstname);
            $lastname =  $this->db->real_escape_string($lastname);
            $bio = $this->db->real_escape_string($bio);


            //SQL fråga
            $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', bio = '$bio', filename = '$file' WHERE id = '$id';";
            $this->db->query($sql);
            $_SESSION['settingsupdate'] = "Dina inställningar har uppdaterats!";
            header("location: settings.php");
            return true;
        }
    }





    public function addClick(string $username)
    {

        $sql = "UPDATE users SET click = click + 1 WHERE username = '$username';";
        $this->db->query($sql);
    }
    public function getTopUsers($num)
    {
        $sql = "SELECT * FROM users ORDER BY click DESC LIMIT $num;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }



    //destructor
    function __destruct()
    {
        // unset($this->db);
        $this->db->close();
    }
}
