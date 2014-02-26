<?php
include("../config/config.inc.php");
$error = User::login($db, $_POST["username"], $_POST["password"]);
if($error != 1)
{
	header("Location: ../index.php?error=".$error);
}
else
{
	header("Location: /layout/in_progress/portal.php");
}
?>