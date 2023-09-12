<html>

<body>
    <div class="body">
        <h2>Admin Dashboard</h2>
        <p class="welcome">Welcome, Admin</p>
        <p>You are now on the administration page of the Online Sweet Selling site. This dashboard gives you full
            control to manage sweet data updates and deletions, as well as to delete customer data.</p>
    </div>
    <div class="addadmin">
        <h3>Create new Admin</h3>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <input type="submit" value="Add Admin"><br><br>
        </form>
    </div>
</body>

<?php
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->admin;

    $insertResult = $collection->insertOne(
        [
            'email' => $email,
            'password' => $password,
            'name' => $name,
        ]
    );

    if ($insertResult->getInsertedCount() > 0) {
        echo "<script>alert('New Admin created successfully!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    }
}
?>

</html>