<?php

class Newpost
{

    //properties
    private $db;
    private $title;
    private $year;
    private $comment;
    private $file;
    private $fileold;
    private $media;
    private $grade;
    private $genre;

    //constructor
    function __construct()
    {
        $this->db = new mysqli('localhost', 'root', 'root', 'blogsdb');
        if ($this->db->connect_errno > 0) {
            die('fel vid anslutning till databasen: ' . $this->db->connect_error);
        }
    }




    // add post
    public function addPost(string $title, string $year, string $comment, string $media, string $genre, string $grade, string $username, $file): bool
    {

        if (!$this->setTitle($title)) return false;
        if (!$this->setYear($year)) return false;
        if (!$this->setComment($comment)) return false;
        if (!$this->setMedia($media)) return false;
        if (!$this->setGrade($grade)) return false;
        if (!$this->setGenre($genre)) return false;
        
        if ((isset($_FILES['file'])) && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/jpg")) {
            if (file_exists("postsimages/" . $_FILES['file']['name'])) {
                $_SESSION['fileexists'] = "Filen " . $_FILES['file']['name'] . " finns redan, välj en annan fil!";
                header("location: createpost.php");
                return false;
            } else {
                //flyttar filen till rätt katalog
                move_uploaded_file($_FILES['file']['tmp_name'], "postsimages/" . str_replace(' ', '', $_FILES['file']['name']));
                $file = str_replace(' ', '', $_FILES['file']['name']);

                //sanitera med real_escape_string
                $title = $this->db->real_escape_string($title);
                $year = $this->db->real_escape_string($year);
                $comment = $this->db->real_escape_string($comment);

                //SQL fråga
                $sql = "INSERT INTO posts(title, year, comment, media, genre, grade, username, filename)VALUES('$title', '$year', '$comment', '$media', '$genre', '$grade', '$username', '$file');";
                $this->db->query($sql);
                $_SESSION['postcreated'] = "Ditt inlägg har publicerats!";
                header("location: index.php");
                return true;
            }
        } else {

            //sanitera med real_escape_string
            $title = $this->db->real_escape_string($title);
            $year = $this->db->real_escape_string($year);
            $comment = $this->db->real_escape_string($comment);

            //SQL fråga
            $sql = "INSERT INTO posts(title, year, comment, media, genre, grade, username)VALUES('$title', '$year', '$comment', '$media', '$genre', '$grade', '$username');";
            $this->db->query($sql);
            $_SESSION['postcreated'] = "Ditt inlägg har publicerats!";
            header("location: index.php");
            return true;
        }
    }

    public function setTitle(string $title): bool
    {
        if ($title != "") {
            $this->title = $title;
            return true;
        } else {
            return false;
        }
    }
    public function setYear($year): bool
    {
        if ($year != "") {
            $this->year = $year;
            return true;
        } else {
            return false;
        }
    }
    public function setComment(string $comment): bool
    {
        if ($comment != "") {
            $this->comment = $comment;
            return true;
        } else {
            return false;
        }
    }
    public function setMedia(string $media): bool
    {
        if ($media != "") {
            $this->media = $media;
            return true;
        } else {
            return false;
        }
    }
    public function setGrade(string $grade): bool
    {
        if ($grade != "") {
            $this->grade = $grade;
            return true;
        } else {
            return false;
        }
    }
    public function setGenre(string $genre): bool
    {
        if ($genre != "") {
            $this->genre = $genre;
            return true;
        } else {
            return false;
        }
    }

















    // get post
    // public function getPost(string $title, string $comment): bool
    // {
    //     $sql = "SELECT * FROM posts;";
    //     $this->db->query($sql);
    //     return true;
    // }

    //get all stored post
    public function printPostsAll($num): array
    {
        $sql = "SELECT * FROM posts ORDER BY created DESC LIMIT $num;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all stored films
    public function printPostsFilms(): array
    {
        $sql = "SELECT * FROM posts WHERE media='film' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all stored series
    public function printPostsSeries(): array
    {
        $sql = "SELECT * FROM posts WHERE media='serie' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all stored documentaris
    public function printPostsDoc(): array
    {
        $sql = "SELECT * FROM posts WHERE media='dokumentär' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get one specific post to info.php when clicked
    public function printPostSpec($id)
    {
        $sql = "SELECT * FROM posts WHERE id='$id';";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all posts by the logged in user
    public function printMyPosts($username)
    {
        $sql = "SELECT * FROM posts WHERE username='$username' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //get all posts from specific user
    public function printPostUser($username)
    {
        $sql = "SELECT * FROM posts WHERE username='$username' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    //print users on index.php
    public function printUsers()
    {
        $sql = "SELECT username FROM users ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }

    // gets amount of posts
    public function getPostsAmount($username)
    {
        $sql = "SELECT COUNT(username)FROM posts WHERE username='$username';";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_assoc($result); //returnerar endast en rad istället för en hel array
    }






    //get edit post values
    public function getEditPost($id)
    {
        $sql = "SELECT * FROM posts WHERE id='$id' ORDER BY created DESC;";
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        // return mysqli_fetch_all($result, MYSQLI_ASSOC);  lagrar i associativ array så det blir lättare att skriva ut på sidan
        return mysqli_fetch_assoc($result); //returnerar endast en rad istället för en hel array
    }

    //add edit post values to db
    public function addEditPost(string $title, int $id, string $year, string $comment, string $media, string $genre, string $grade, $file, $fileold): bool
    {

        if (!$this->setTitle($title)) return false;
        if (!$this->setYear($year)) return false;
        if (!$this->setComment($comment)) return false;

        if ((isset($_FILES['file'])) && ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/jpg")) {

            //flyttar filen till rätt katalog
            move_uploaded_file($_FILES['file']['tmp_name'], "postsimages/" . str_replace(' ', '', $_FILES['file']['name']));
            $file = str_replace(' ', '', $_FILES['file']['name']);

            $title = $this->db->real_escape_string($title);
            $year = $this->db->real_escape_string($year);
            $comment = $this->db->real_escape_string($comment);

            //SQL fråga
            $sql = "UPDATE posts SET title = '$title', year = '$year', comment = '$comment', media = '$media', genre = '$genre', grade = '$grade', filename = '$file' WHERE id = '$id';";
            $this->db->query($sql);
            header("location: myposts.php");
            $_SESSION['postupdated'] = "Ditt inlägg har uppdaterats!";
            return true;
        } else {

            //flyttar filen till rätt katalog

            $file = $fileold;

            $title = $this->db->real_escape_string($title);
            $year = $this->db->real_escape_string($year);
            $comment = $this->db->real_escape_string($comment);

            //SQL fråga
            $sql = "UPDATE posts SET title = '$title', year = '$year', comment = '$comment', media = '$media', genre = '$genre', grade = '$grade', filename = '$file' WHERE id = '$id';";
            $this->db->query($sql);
            header("location: myposts.php");
            $_SESSION['postupdated'] = "Ditt inlägg har uppdaterats!";
            return true;
        }
    }


    


    public function addRead($id)
    {
        $sql = "UPDATE posts SET click = (click + 1) WHERE id='$id';"; 
        $this->db->query($sql);
    }
    public function getTopRead($num)
    {
        $sql = "SELECT * FROM posts ORDER BY click DESC LIMIT $num;"; 
        $result = $this->db->query($sql); //lagrar svaret från servern i $result
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // lagrar i associativ array så det blir lättare att skriva ut på sidan
    }





    // delete post
    public function deletePost(string $id): bool
    {
        $sql = "DELETE FROM posts WHERE id=$id;";
        return $this->db->query($sql);
        return true;
    }



    //destructor
    function __destruct()
    {
        $this->db->close();
    }
}
