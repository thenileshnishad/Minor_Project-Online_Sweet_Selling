<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Generated Bills</h2>
        <p>Generated bills will be displayed here</p>
    </body>

    </html>
<?php
} else {
    header("Location: signin.php");
}
?>