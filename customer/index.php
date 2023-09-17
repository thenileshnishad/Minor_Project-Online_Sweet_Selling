<?php
session_name("customer");
session_start();

if (isset($_SESSION["signedin"]) == true) {
?>
    <html>

    <head>
        <title>Online Sweet Selling</title>
        <link rel="stylesheet" href="css/indexStyle.css">
    </head>

    <body>
        <div class="heading">
            <a href="index.php">
                <img src="../admin/site_images/OSS.jpg" alt="Logo" class="logo">
                <h1>Welcome to Online Sweet Selling</h1>
                <img src="../admin/site_images/OSS.jpg" alt="Logo" class="logo">
            </a>
        </div>

        <div class="nav">
            <a href="index.php">Home</a>
            <a href="index.php?custprofile">Welcome <?php echo $_SESSION['custName']; ?></a>
            <a href="logout.php">Logout</a>
        </div>
    </body>

    </html>
<?php
    if (isset($_GET['custprofile'])) {
        include("custprofile.php");
    }
} else {
    header("Location: signin.php");
}
?>