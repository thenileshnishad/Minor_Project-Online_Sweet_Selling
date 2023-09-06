<?php

if (isset($_SESSION["signedin"]) == true) { ?>

    <body>
        <form action="" method="post" enctype="multipart/form-data" class="sweet-form">
            <label for="sweetname">Sweet name:</label>
            <input type="text" id="sweetname" name="sweet_name" required><br>

            <label for="sweetimg">Sweet image:</label>
            <input type="file" id="sweetimg" name="sweet_image" required><br>

            <label for="sweetprice">Sweet price:</label>
            <input type="text" id="sweetprice" name="sweet_price" required><br>

            <label for="sweetdesc">Sweet description:</label>
            <textarea id="sweetdesc" name="sweet_desc" cols="20" rows="8"></textarea><br>

            <input type="submit" id="submit" name="insert_post" value="Insert Product Now" />
        </form>
    </body>
    </html>
<?php } ?>

<?php
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sweet_name = $_POST["sweet_name"];
    $sweet_price = $_POST["sweet_price"];
    $sweet_desc = $_POST["sweet_desc"];


    $sweet_image = $_FILES['sweet_image']['name'];
    $sweet_image_tmp = $_FILES['sweet_image']['tmp_name'];
    move_uploaded_file($sweet_image_tmp, "sweet_images/$sweet_image");


    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->sweets;

    $insertResult = $collection->insertOne(
        [
            "sweet_name" => $sweet_name,
            "sweet_price" => $sweet_price,
            "sweet_desc" => $sweet_desc,
            "sweet_image" => $sweet_image
        ]
    );

    if ($insertResult->getInsertedCount() > 0) {
        echo "<script>alert('Sweet data has been inserted!');</script>";
        echo "<script>window.location.href='index.php?manage_sweets';</script>";
    }
}
?>