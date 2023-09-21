<?php
if (isset($_SESSION["signedin"]) == true) {
    print_r($_SESSION["cart"]);
} else {
    header("Location: signin.php");
}
?>