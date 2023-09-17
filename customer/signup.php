<html>
<head>
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="css/signupStyle.css">
</head>
<body>
    <h2>Customer Sign Up</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="mobno">Mobile number:</label>
        <input type="number" id="mobno" name="mobno" required><br><br>

        <input type="submit" value="Sign Up"><br><br>

        <a href="signin.php">Have an account?</a>
    </form>
</body>
</html>

<?php
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $mobno = $_POST["mobno"];

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->customers;

    $insertResult = $collection->insertOne([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'address' => $address,
        'mobno' => $mobno
    ]
    );

    if ($insertResult->getInsertedCount() > 0) {
        echo "<script>alert('Account created successfully!')</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "User registration failed.";
    }
}
?>