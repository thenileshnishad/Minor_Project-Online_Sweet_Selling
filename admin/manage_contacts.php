<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Customer Messages</h2>
        <h4>Here, you can see the messages sent by customers</h4>
    </body>

    </html>
<?php
} else {
    header("Location: signin.php");
}
?>