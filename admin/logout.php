<?php
session_name("admin");
session_start();
session_unset();
session_destroy();
?>

<html>
<head>
    <title>Admin Logged Out</title>
</head>
<body>
    <script>
        alert("You have been logged out!");
        window.location.href = "signin.php";
    </script>
</body>
</html>