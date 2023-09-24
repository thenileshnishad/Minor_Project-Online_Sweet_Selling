<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Customer Messages</h2>
        <table class="user-table" border="1">
            <tr>
                <th>Customer name</th>
                <th>Email</th>
                <th>Regarding (Sweet name)</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Delete</th>
            </tr>

            <?php
            require '../vendor/autoload.php';

            $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
            $database = $mongoClient->sweetselling;
            $collection = $database->contact_forms;

            $contacts = $collection->find(); ?>

            <?php foreach ($contacts as $list) { ?>
                <tr>
                    <td><?php echo $list["name"]; ?></td>
                    <td><?php echo $list["email"]; ?></td>
                    <td><?php echo $list["regsweetname"]; ?></td>
                    <td><?php echo $list["subject"]; ?></td>
                    <td><?php echo $list["message"]; ?></td>
                    <td>Delete</td>
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