<?php
session_start();
session_unset();
session_destroy();
?>

<html>
    <head>
        <title>Logged Out</title>
    </head>
    <body>
        <h3>You have been logged out</h3>
        <a href="index.php"><button>Return to home page</button></a>
    </body>
</html>