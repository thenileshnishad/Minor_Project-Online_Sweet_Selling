<?php

if (isset($_SESSION["signedin"]) == true) { ?>
    <html>

    <head>
        <link rel="stylesheet" href="css/cust&contactStyle.css">
    </head>

    <body>
        <h2>Contact Us</h2>
        <form action="" method="post">
            <label for="reg">Regarding (Sweet name):</label>
            <input type="text" id="reg" name="regarding" required><br><br>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required><br><br>

            <label for="message">Message:</label>
            <textarea name="message" id="message" required></textarea><br><br>

            <input type="submit" id="submit" name="send" value="Send Message"><br><br>

            <a href="https://github.com/thenileshnishad/Minor_Project-Online_Sweet_Selling">Check out the project's source code</a>
        </form>
    </body>

    </html>
<?php
    require '../vendor/autoload.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $regarding = $_POST["regarding"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        $name = $_SESSION["custName"];
        $email = $_SESSION["email"];

        $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        $database = $mongoClient->sweetselling;
        $collection = $database->contact_forms;

        $insertResult = $collection->insertOne(
            [
                'name' => $name,
                'email' => $email,
                'regsweetname' => $regarding,
                'subject' => $subject,
                'message' => $message
            ]
        );

        if ($insertResult->getInsertedCount() > 0) {
            echo '<script>alert("Thank you for contacting us!\nWe have received your message and will get back to you soon.")</script>';
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "User registration failed.";
        }
    }
} else {
    header("Location: signin.php");
}
?>