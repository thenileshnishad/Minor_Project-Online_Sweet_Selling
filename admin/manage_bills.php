<?php
if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="">
    </head>

    <body>
        <h2>Generated Bills</h2>
        <table border="1">
            <tr>
                <th>Bill ID</th>
                <th>Customer name</th>
                <th>Email</th>
                <th>Total</th>
                <th>Timestamp</th>
                <th>Delete</th>
            </tr>
        </table>
    </body>

    </html>
<?php
} else {
    header("Location: signin.php");
}
?>