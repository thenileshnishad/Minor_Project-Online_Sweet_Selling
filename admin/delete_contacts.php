<?php
session_name("admin");
session_start();

if (isset($_SESSION["signedin"]) == true) {
    require '../vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->contact_forms;

    $delcontact = $_GET["delcontact"];

    $deleteContact = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($delcontact)]);

    if ($deleteContact) {
        header("Location: index.php?manage_contacts");
    }
} else {
    header("Location: signin.php");
}
?>