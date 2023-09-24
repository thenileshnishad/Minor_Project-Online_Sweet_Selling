<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="css/mng_Cust_Contact_BillsStyle.css">
    </head>

    <body>
        <h2>Generated Bills</h2>
        <table class="user-table">
            <tr>
                <th>Bill ID</th>
                <th>Customer name</th>
                <th>Email</th>
                <th>Total</th>
                <th>Timestamp</th>
                <th>Delete</th>
            </tr>

            <?php
            require '../vendor/autoload.php';

            $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
            $database = $mongoClient->sweetselling;
            $collection = $database->bills;

            $bills = $collection->find(); ?>

            <?php foreach ($bills as $list) { ?>
                <tr>
                    <td><?php echo $list["_id"]; ?></td>
                    <td><?php echo $list["custName"]; ?></td>
                    <td><?php echo $list["email"]; ?></td>
                    <td>Rs. <?php echo $list["total"]; ?></td>
                    <td><?php echo date('d-m-Y g:i:s A', $list['timestamp']->toDateTime()->getTimestamp()); ?></td>
                    <td><a href="delete_bills.php?delbill=<?php echo $list["_id"]; ?>" class="delete-link">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
    </body>

    </html>
<?php
} else {
    header("Location: signin.php");
}
?>