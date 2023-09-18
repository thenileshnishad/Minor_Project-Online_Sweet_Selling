<html>

<head>
    <title>Change the password</title>
    <link rel="stylesheet" href="">
</head>

<body>
    <h2>Change your password</h2>
    <form action="" method="post">
        <label for="oldpasswd">Enter Current Password:</label>
        <input type="password" id="oldpasswd" name="oldpasswd" required><br><br>

        <label for="newpasswd">Enter New Password:</label>
        <input type="password" id="newpasswd" name="newpasswd" required><br><br>

        <label for="confpasswd">Re-Enter New Password:</label>
        <input type="password" id="confpasswd" name="confpasswd" required><br><br>

        <input type="submit" value="Change Password">
    </form>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldpasswd = $_POST["oldpasswd"];
    $newpasswd = $_POST["newpasswd"];
    $confpasswd = $_POST["confpasswd"];

    if ($newpasswd === $confpasswd) {
        require '../vendor/autoload.php';

        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $database = $mongoClient->sweetselling;
        $collection = $database->customers;

        $checkPasswd = $collection->findone([
            "password" => $oldpasswd
        ]);

        if (!$checkPasswd) {
            echo
            '<script>
                alert("Current Password is Wrong!");
                window.location.href = "index.php?custpasswd";
            </script>';
        }

        if ($checkPasswd) {
            $updatePasswd = $collection->updateOne(
                ["email" => $_SESSION["email"]],
                [
                    '$set' => [
                        "password" => $confpasswd
                    ]
                ]
            );

            if ($updatePasswd) {
                echo
                '<script>
                    alert("Password Changed Successfully!");
                    window.location.href = "index.php";
                </script>';
            }
        }
    } else {
        echo
        '<script>
            alert("Check your Re-Enter Password Field");
            window.location.href = "index.php?custpasswd";
        </script>';
    }
}
?>