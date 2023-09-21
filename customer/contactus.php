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

            <input type="submit" id="submit" name="send" value="Send Message">
        </form>
    </body>

    </html>
<?php } else {
    header("Location: signin.php");
}
?>