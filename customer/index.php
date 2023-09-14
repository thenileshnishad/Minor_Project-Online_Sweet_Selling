<?php
session_name("customer");
session_start();

if (isset($_SESSION["signedin"]) == true) {
?>
    <html>

    <head>
        <title>Online Sweet Selling</title>
    </head>

    <body>
        <h1>Welcome to Online Sweet Selling</h1>
        <div class="nav">
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </body>

    </html>
<?php
    echo "Welcome " . $_SESSION["custName"];
} else {
    header("Location: signin.php");
}
?>