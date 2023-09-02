<?php
session_start();
session_unset();
session_destroy();
?>

<html>
    <head>
        <title>Admin Logged Out</title>
    </head>
    <body>
        <h3>You have been logged out</h3>
        <a href="signin.php"><button>Return to the singin page</button></a>
    </body>
</html>