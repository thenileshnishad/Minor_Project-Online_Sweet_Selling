<?php
require '../vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->sweetselling;
$collection = $database->sweets;

$sweetsList = $collection->find();
?>

<html>

<head>
    <link rel="stylesheet" href="">
</head>

<body>
    <div class="sweet-box">
        <?php
        foreach ($sweetsList as $list) { ?>
            <div class="sweet">
                <h3><?php echo $list["sweet_name"]; ?></h3>
                <img class="sweetimg" src="../admin/sweet_images/<?php echo $list['sweet_image']; ?>" width='250' height='250' alt='img'>
                <p class="price">Rs.<?php echo $list["sweet_price"]; ?></p>
                <p class="description"><?php echo $list["sweet_desc"] ?></p>
                <button>Add to Cart</button>
            </div>
        <?php } ?>
    </div>
</body>

</html>