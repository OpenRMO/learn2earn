<?php
include("../config/config.inc.php");
$error = User::login($db, $_POST["username"], $_POST["password"]);
header("Location: index.php?error=".$error);