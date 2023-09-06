<?php
session_start();

if (isset($_SESSION["signedin"]) == true) {
?>
    <html>
    <head>
        <title>Welcome Admin</title>
        <link rel="stylesheet" href="css/indexStyle.css">
    </head>
    <body>
        <div class="heading">
            <a href="index.php">
                <h1>Welcome to Admin Panel of Online Sweet Selling</h1>
            </a>
        </div>
        <div class="nav">
            <a href="index.php?add_sweets">Add Sweets</a>
            <a href="index.php?manage_sweets">Manage Sweets</a>
            <a href="logout.php">Admin Logout</a>
        </div>
    </body>
    </html>
<?php
    if (isset($_GET['add_sweets'])) {
        include("add_sweets.php");
    }

    if (isset($_GET['manage_sweets'])) {
        include("manage_sweets.php");
    }

    if (isset($_GET['edit_sweets'])) {
        include("edit_sweets.php");
    }
} else {
    header("Location: signin.php");
}
?>