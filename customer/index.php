<?php
session_start();

if (isset($_SESSION["signedin"]) == true) {
    echo "Welcome". $_SESSION["username"];
    echo '<br><br><a href="logout.php">Logout</a>';
} else {
    header("Location: signin.html");
}
?>