<?php
$username = $_POST["username"];
$password = $_POST["password"];

include "../config/config.inc.php";
include "../classes/user.class.php";
$error = User::login($db, $username, $password);
if($error === 1)
{
    header("Location: index.php");
}
else
{
    header("Location: index.php?error=$error");
}
?>