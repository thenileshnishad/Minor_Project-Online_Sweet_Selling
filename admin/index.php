<?php
session_name("admin");
session_start();

if (isset($_SESSION["signedin"]) == true) {
?>
    <html>
    <head>
        <title>Welcome Admin</title>
        <link rel="shortcut icon" href="../admin/site_images/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/indexStyle.css">
    </head>
    <body>
        <div class="heading">
            <a href="index.php">
                <img src="../admin/site_images/OSS.jpg" alt="Logo" class="logo">
                <h1>Welcome to Admin Panel of Online Sweet Selling</h1>
                <img src="../admin/site_images/OSS.jpg" alt="Logo" class="logo">
            </a>
        </div>
        <div class="nav">
            <a href="index.php?add_sweets">Add Sweets</a>
            <a href="index.php?manage_sweets">Manage Sweets</a>
            <a href="index.php?manage_customers">Manage Customers</a>
            <a href="index.php?manage_bills">Invoices</a>
            <a href="index.php?manage_contacts">Messages</a>
            <a href="logout.php">Admin Logout</a>
        </div>
    </body>
    </html>
<?php
    if (isset($_GET['add_sweets'])) {
        include("add_sweets.php");
    }

    if (isset($_GET['manage_contacts'])) {
        include("manage_contacts.php");
    }

    if (isset($_GET['manage_sweets'])) {
        include("manage_sweets.php");
    }

    if (isset($_GET['manage_customers'])) {
        include("manage_customers.php");
    }

    if (isset($_GET['manage_bills'])) {
        include("manage_bills.php");
    }

    if (isset($_GET['edit_sweets'])) {
        include("edit_sweets.php");
    }

    if (!isset($_GET['add_sweets'])) {
        if (!isset($_GET['manage_sweets'])) {
            if (!isset($_GET['manage_customers'])) {
                if (!isset($_GET['edit_sweets'])) {
                    if (!isset($_GET['manage_bills'])) {
                        if (!isset($_GET['manage_contacts'])) {
                            include("front.php");
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: signin.php");
}
?>