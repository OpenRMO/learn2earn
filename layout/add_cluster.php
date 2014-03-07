<?php
include_once("../config/config.inc.php");

$cluster_name = $_POST["cluster_name"];
$users = $_POST["users"];

$project1 = $_POST["project1"];
$project2 = $_POST["project2"];
$project3 = $_POST["project3"];
$project4 = $_POST["project4"];

//$cluster_id = Cluster::add($db, $cluster_name, $users);

echo $project2;

//header("Location: register.php?error=$error");
?>