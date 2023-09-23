<?php
session_name("admin");
session_start();

if (isset($_SESSION["signedin"]) == true) {
    require '../vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->bills;

    $delbill = $_GET["delbill"];

    $deleteBill = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($delbill)]);

    if ($deleteBill) {
        header("Location: index.php?manage_bills");
    }
} else {
    header("Location: signin.php");
}
?>