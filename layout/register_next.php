<?php

include("../config/config.inc.php");
$username = $_POST["username"];
$pass1 = $_POST["password1"];
$pass2 = $_POST["password2"];
$fn = $_POST["firstname"];
$ln = $_POST["lastname"];
$studentNumber = $_POST["studentnumber"];
$birthDate = $_POST["birthdate"];
$email = $_POST["email"];

$error = User::register($db, $username, $pass1, $pass2, $fn, $ln, $studentNumber, $birthdate, $email);

header("Location: register.php?error=$error");
?>