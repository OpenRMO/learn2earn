<?php
include_once("../config/config.inc.php");

$username = $_POST["username"]; 
$password1 = $_POST["password1"]; 
$password2  = $_POST["password2"];
$first_name = $_POST["firstname"];
$last_name = $_POST["lastname"];
$student_number = $_POST["studentnumber"];
$birth_date = $_POST["birthdate"];
$email = $_POST["email"];
$c_name = $_POST["cluster"];

$tmp = $db->select("clusters", array("id"), array("name"=>$c_name));
$c = $tmp[0]["id"];

//add user to user table
$error = User::register($db, $username, $password1, $password2, $first_name, $last_name, $student_number, $birth_date, $email);
$id = $db->select("users", array("id"), array("username"=>$username));

//add user to cluster
$cluster = new Cluster($db, $c);
$cluster->addUsers(array($id[0]["id"]));

header("Location: register.php?error=$error");
?>