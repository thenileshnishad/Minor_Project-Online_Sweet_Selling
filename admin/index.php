<?php
session_start();

if (isset($_SESSION["signedin"]) == true) {
?>
    <html>
    <head>
        <title>Welcome Admin</title>
    </head>
    <body>
        <div>
            <a href="index.php">
                <h1>Welcome to Admin Panel of Online Sweet Selling</h1>
            </a>
        </div>
        <div class="nav">
            <a href="index.php?add_sweets">Add Sweets</a>
            <a href="index.php?manage_sweets">Manage Sweets</a>
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