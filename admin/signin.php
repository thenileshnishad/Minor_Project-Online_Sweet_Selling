<html>
<head>
    <title>Admin Sign In</title>
    <link rel="stylesheet" href="css/signinStyle.css">
</head>
<body>
    <h2>Admin Sign In</h2>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Sign In"><br><br>
    </form>
</body>
</html>

<?php
require '../vendor/autoload.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $database = $mongoClient->sweetselling;
    $collection = $database->admin;

    $adminData = $collection->findone([
        "email" => $email,
        "password" => $password
    ]);

    if ($adminData) {
        $_SESSION["email"] = $email;
        $_SESSION["adminName"] = $adminData["name"];

        $_SESSION["signedin"] = true;
        header("Location: index.php");
    } else {
        echo "Invalid email or password.";
    }
}
?>