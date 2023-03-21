<?php
if (isset($_SESSION['username'])) {
    include("includes/navbar_loggedin.php");
} else {
    include("includes/navbar.php");
}
?>