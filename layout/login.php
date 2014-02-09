<?php
$username = $_POST["username"];
$password = $_POST["password"];

include "../config/config.inc.php";
$error = User::login($db, $username, $password);

    header("Location: index.php?error=$error");
?>