<?php
$username = $_POST["username"];
$password = $_POST["password"];

include "../config/config.inc.php";
$error = User.login($db, $username, $password);
if($error == 1)
{
    //ingelogd!
}
else
{
    header("Location: index.php?error='$error'");
}
?>