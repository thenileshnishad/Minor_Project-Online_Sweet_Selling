<?php
require '../vendor/autoload.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->customers;

    $userData = $collection->findone([
        "email" => $email,
        "password" => $password
    ]);

    if ($userData) {
        $_SESSION["email"] = $email;
        $_SESSION["custName"] = $userData["name"];
        $_SESSION["address"] = $userData["address"];
        $_SESSION["mobile"] = $userData["mobno"];

        $_SESSION["signedin"] = true;
        header("Location: index.php");
    } else {
        echo "Invalid email or password.";
        echo '<br><br><a href="signup.html">Go to home page</a>';
    }
}
?>