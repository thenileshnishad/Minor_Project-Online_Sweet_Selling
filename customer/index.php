<?php
session_start();

if (isset($_SESSION["signedin"]) == true) {
    echo "Welcome". $_SESSION["username"];
} else {
    header("Location: signin.html");
}
?>