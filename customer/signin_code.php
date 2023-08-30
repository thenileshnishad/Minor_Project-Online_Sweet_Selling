<?php
require '../vendor/autoload.php';

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
        echo "Sign-in successful!";
    } else {
        echo "Invalid email or password.";
    }
}
?>