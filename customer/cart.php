<?php

if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Shopping Cart</h2>
        <?php

        $total = 0;
        if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) { ?>
            <table class="cart-detail">
                <tr>
                    <th>Sweet Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
                <?php foreach ($_SESSION["cart"] as $sweetid => $cartitem) {
                    $subtotal = $cartitem["sweetprice"] * $cartitem["sweetquantity"];
                    $total += $subtotal; ?>
                    <tr>
                        <td><?php echo $cartitem["sweetname"]; ?></td>
                        <td>Rs. <?php echo $cartitem["sweetprice"]; ?></td>
                        <td><?php echo $cartitem["sweetquantity"]; ?></td>
                        <td>Rs. <?php echo $subtotal; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="sweetid" value="<?php echo $sweetid; ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <div class="checkout">
                <h2>Total: Rs. <?php echo $total ?></h2>
                <form action="" method="post">
                    <button name="generatebill">Checkout</button>
                </form>
            </div>
        <?php
        } else {
            echo "<h2>Your cart is empty!</h2>";
        } ?>
    </body>

    </html>
<?php
    if (isset($_POST["remove"])) {
        $sweetid_to_remove = $_POST["sweetid"];
        unset($_SESSION["cart"][$sweetid_to_remove]);
        echo '<script>alert("Sweet successfully removed from the cart!");</script>';
        echo '<script>window.location.href="index.php?cart";</script>';
    }

    if (isset($_POST["generatebill"]) && !empty($_SESSION["cart"])) {
        $cart = $_SESSION["cart"];
        $total = 0;

        foreach ($cart as $sweetid => $cartitem) {
            $subtotal = $cartitem["sweetprice"] * $cartitem["sweetquantity"];
            $total += $subtotal;
        }

        require '../vendor/autoload.php';

        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $database = $mongoClient->sweetselling;
        $collection = $database->bills;

        // Adding + 5:30 in UTC timestamp
        $timestamp = new MongoDB\BSON\UTCDateTime();
        $dateTime = $timestamp->toDateTime();
        $dateTime->add(new DateInterval('PT5H30M'));
        $timestamp = new MongoDB\BSON\UTCDateTime($dateTime);

        $insertResult = $collection->insertOne(
            [
                "custName" => $_SESSION["custName"],
                "email" => $_SESSION["email"],
                "item" => $_SESSION["cart"],
                "total" => $total,
                "timestamp" => $timestamp
            ]
        );

        $objectId = $insertResult->getInsertedId();

        if ($insertResult) {
            $_SESSION["cart"] = [];

            echo '<script> alert("Total Amount: Rs.' . $total . '\nBill ID: ' . $objectId . '\nConfirmation: Bill generated successfully.\n\nKeep this Bill ID safe. It is your checkout proof, and if you need help, feel free to ask."); </script>';

            echo "<script>window.location.href='index.php?cart';</script>";
        }
    }
} else {
    header("Location: signin.php");
}
?>