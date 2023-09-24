<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="css/mng_Cust_Contact_BillsStyle.css">
    </head>

    <body>
        <h2>Delete Customer Details from Here</h2>
        <table class="user-table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Mobile</th>
                <th>Delete</th>
            </tr>

            <?php
            require '../vendor/autoload.php';

            $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
            $database = $mongoClient->sweetselling;
            $collection = $database->customers;

            $customerList = $collection->find(); ?>

            <?php foreach ($customerList as $list) { ?>
                <tr>
                    <td><?php echo $list["name"]; ?></td>
                    <td><?php echo $list["email"]; ?></td>
                    <td><?php echo $list["address"]; ?></td>
                    <td><?php echo $list["mobno"]; ?></td>
                    <td><a href="delete_customer.php?delcustomer=<?php echo $list["_id"]; ?>" class="delete-link">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
    </body>

    </html>

<?php } else {
    header("Location: signin.php");
}
?>