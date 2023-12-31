<?php

if (isset($_SESSION["signedin"]) == true) {
    if (isset($_SESSION["signedin"]) == true) {
        require '../vendor/autoload.php';

        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $database = $mongoClient->sweetselling;
        $collection = $database->customers;
        $customer = $collection->findOne([
            "email" => $_SESSION["email"]
        ]);

        if ($customer) {
            $custName = $customer->name;
            $custAddress = $customer->address;
            $custMob = $customer->mobno;
        }
    } ?>

    <html>

    <head>
        <link rel="stylesheet" href="css/cust&contactStyle.css">
    </head>

    <body>
        <h2>Update Your Detail</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo $custName; ?>"><br><br>

            <label for="address">Address:</label>
            <textarea name="address" id="address" required><?php echo $custAddress; ?></textarea><br><br>

            <label for="mobno">Mobile number:</label>
            <input type="number" id="mobno" name="mobno" required value="<?php echo $custMob; ?>"><br><br>

            <input type="submit" id="submit" name="update" value="Update"><br><br>

            <a href="index.php?custpasswd">Change your password</a>
        </form>
    </body>

    </html>
<?php
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $stringmob = $_POST['mobno'];
        $mob = (int)$stringmob;

        $custUpdate = $collection->updateOne(
            ["email" => $_SESSION["email"]],
            [
                '$set' => [
                    "name" => $name,
                    "address" => $address,
                    "mobno" => $mob
                ]
            ]
        );
        if ($custUpdate) {
            $_SESSION["custName"] = $name;
            $_SESSION["address"] = $address;
            $_SESSION["mobile"] = $mob;

            echo
            '<script>
            alert("Details Updated Successfully!");
            window.location.href = "index.php";
        </script>';
        }
    }
} else {
    header("Location: signin.php");
}
?>