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
        $_SESSION["custName"] = $_POST["name"];
        $_SESSION["address"] = $_POST["address"];
        $_SESSION["mobile"] = $_POST["mobno"];

        $_SESSION["signedin"] = true;
        header("Location: index.php");
    } else {
        echo "Invalid email or password.";
    }
}
?>