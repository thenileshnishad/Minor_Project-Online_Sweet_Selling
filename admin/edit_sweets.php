<?php
if (isset($_SESSION["signedin"]) == true) {
    require '../vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->sweets;

    $sweetid = $_GET["edit_sweets"];

    $sweetList = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($sweetid)]);

    if ($sweetList) {
        $id = $sweetList->_id;
        $sweet_name = $sweetList->sweet_name;
        $sweet_price = $sweetList->sweet_price;
        $sweet_desc = $sweetList->sweet_desc;
    } ?>
    <html>

    <head>
        <link rel="stylesheet" href="css/edit_sweetsStyle.css">
    </head>

    <body>
        <h2>Edit Sweet Data</h2>
        <form action="" method="post" enctype="multipart/form-data" class="sweet-form">
            <label for="sweetname">Sweet name:</label>
            <input type="text" id="sweetname" name="sweet_name" value="<?php echo $sweet_name; ?>" /><br>

            <label for="sweetimg">Sweet image:</label>
            <input type="file" id="sweetimg" name="sweet_image" /><br>

            <label for="sweetprice">Sweet price:</label>
            <input type="text" id="sweetprice" name="sweet_price" value="<?php echo $sweet_price; ?>" /><br>

            <label for="sweetdesc">Sweet description:</label>
            <textarea id="sweetdesc" name="sweet_desc" cols="20" rows="8"><?php echo $sweet_desc ?></textarea><br>

            <input type="submit" id="submit" name="update" value="Update Product" />
        </form>
    </body>

    </html>

<?php
    if (isset($_POST['update'])) {
        $sweet_name = $_POST['sweet_name'];

        $sweet_image = $_FILES['sweet_image']['name'];
        $sweet_image_tmp = $_FILES['sweet_image']['tmp_name'];
        move_uploaded_file($sweet_image_tmp, "sweet_images/$sweet_image");

        $stringsweet_price = $_POST['sweet_price'];
        $sweet_price = (float)$stringsweet_price;
        $sweet_desc = $_POST['sweet_desc'];

        $sweetUpdate = $collection->updateOne(
            ["_id" => $id],
            [
                '$set' => [
                    "sweet_name" => $sweet_name,
                    "sweet_image" => $sweet_image,
                    "sweet_price" => $sweet_price,
                    "sweet_desc" => $sweet_desc
                ]
            ]
        );
        if ($sweetUpdate) {
            header("Location: index.php?manage_sweets");
        }
    }
} else {
    header("Location: signin.php");
}
?>