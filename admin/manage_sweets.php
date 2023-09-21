<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="css/manage_sweetsStyle.css">
    </head>
    <h2>Edit and Delete Sweet Details from Here</h2>
    <table class="sweet-table">
        <tr>
            <th>Sweet name</th>
            <th>Sweet image</th>
            <th>Sweet price</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php
        require '../vendor/autoload.php';

        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $database = $mongoClient->sweetselling;
        $collection = $database->sweets;

        $sweetList = $collection->find(); ?>

        <?php foreach ($sweetList as $sweet) { ?>
            <tr>
                <td><?php echo $sweet['sweet_name']; ?></td>
                <td><img src="sweet_images/<?php echo $sweet['sweet_image']; ?>" width="60" height="60" /></td>
                <td><?php echo $sweet['sweet_price']; ?></td>
                <td><?php echo $sweet['sweet_desc']; ?></td>
                <td><a href="index.php?edit_sweets=<?php echo $sweet['_id']; ?>" class="edit-link">Edit</a></td>
                <td><a href="delete_sweets.php?delsweet=<?php echo $sweet['_id']; ?>" class="delete-link">Delete</a></td>
            </tr>
        <?php } ?>
    </table>

    </html>
<?php } else {
    header("Location: signin.php");
}
?>