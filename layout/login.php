<?php
$username = $_POST["username"];
$password = $_POST["password"];

include "../config/config.inc.php";
$error = User.getUsername();
if($error === 1)
{
    header("Location: index.php");
}
else
{
    header("Location: index.php?error='$error'");
}
?>