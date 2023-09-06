<?php
session_start();

if (isset($_SESSION["signedin"]) == true) {
    require '../vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->sweets;

    $delsweet = $_GET["delsweet"];

    $deleteSweet = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($delsweet)]);

    if ($deleteSweet) {
        header("Location: index.php?manage_sweets");
    }
} else {
    header("Location: signin.php");
}
?>