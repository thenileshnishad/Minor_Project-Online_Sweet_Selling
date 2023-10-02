<?php

if (isset($_SESSION["signedin"]) == true) {
    require '../vendor/autoload.php';

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->sweets;

    $sweetsList = $collection->find(); ?>
    <html>

    <head>
        <link rel="stylesheet" href="css/sweetsStyle.css">
    </head>

    <body>
        <div class="sweet-box">
            <?php
            foreach ($sweetsList as $list) { ?>
                <form class="sweet" action="" method="post">
                    <div>
                        <h3><?php echo $list["sweet_name"]; ?></h3>
                        <a href="../admin/sweet_images/<?php echo $list['sweet_image']; ?>" target="_blank">
                            <img class="sweetimg" src="../admin/sweet_images/<?php echo $list['sweet_image']; ?>" width='250' height='250' alt='img'>
                        </a>
                        <p class="price">Rs.<?php echo $list["sweet_price"]; ?></p>
                        <p class="description"><?php echo $list["sweet_desc"] ?></p>

                        <input type="hidden" name="sweetid" value="<?php echo $list["_id"]; ?>">

                        <button name="addtocart">Add to Cart</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </body>

    </html>
    <?php
    if (isset($_POST["addtocart"])) {
        $sweetid = $_POST["sweetid"];

        $sweet = $collection->findOne([
            "_id" => new MongoDB\BSON\ObjectID($sweetid)
        ]);

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }
        $_SESSION["cart"][$sweetid] = [
            "sweetname" => $sweet["sweet_name"],
            "sweetprice" => $sweet["sweet_price"],
            "sweetquantity" =>  isset($_SESSION["cart"][$sweetid]["sweetquantity"]) ? $_SESSION["cart"][$sweetid]["sweetquantity"] + 1 : 1
        ]; ?>
        <script>
            alert("Sweet successfully added to the cart!");
        </script>
<?php }
} else {
    header("Location: signin.php");
}
?>