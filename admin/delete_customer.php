<?php
session_name("admin");
session_start();

if (isset($_SESSION["signedin"]) == true) {
    require '../vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->customers;

    $delcustomer = $_GET["delcustomer"];

    $deleteCustomer = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($delcustomer)]);

    if ($deleteCustomer) {
        header("Location: index.php?manage_customers");
    }
} else {
    header("Location: signin.php");
}
?>