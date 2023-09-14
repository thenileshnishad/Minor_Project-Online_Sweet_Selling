<?php
session_name("customer");
session_start();

if (isset($_SESSION["signedin"]) == true) {
    echo "Welcome ". $_SESSION["custName"];
    echo '<br><br><a href="logout.php">Logout</a>';
} else {
    header("Location: signin.php");
}
?>