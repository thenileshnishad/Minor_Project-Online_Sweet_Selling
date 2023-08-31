<?php
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $mobno = $_POST["mobno"];

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->customers;

    $insertResult = $collection->insertOne([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'address' => $address,
        'mobno' => $mobno
    ]
    );

    if ($insertResult->getInsertedCount() > 0) {
        header('Location: signin.html');
    } else {
        echo "User registration failed.";
    }
}
?>