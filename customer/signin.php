<html>
<head>
    <title>Customer Sign In</title>
</head>
<body>
    <h2>Customer Sign In</h2>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign In"><br><br>

        <a href="signup.php">Don't have an account?</a>
    </form>
</body>
</html>

<?php
require '../vendor/autoload.php';
session_name("customer");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->customers;

    $userData = $collection->findone([
        "email" => $email,
        "password" => $password
    ]);

    if ($userData) {
        $_SESSION["email"] = $email;
        $_SESSION["custName"] = $userData["name"];
        $_SESSION["address"] = $userData["address"];
        $_SESSION["mobile"] = $userData["mobno"];

        $_SESSION["signedin"] = true;
        header("Location: index.php");
    } else {
        echo "Invalid email or password.";
        echo '<br><br><a href="index.php">Go to home page</a>';
    }
}
?>