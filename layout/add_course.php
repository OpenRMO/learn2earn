<?php
if(!isset($_POST['project']) || !isset($_POST['beschrijving'])){
    die(header("Location: register.php?error=2"));
}

include("../config/config.inc.php");
is_int($_POST["project"]) ? header("Location: register.php?error=2") : $project = ($_POST["project"]);
$description = $db->escape($_POST["beschrijving"]);
isset($_FILES) ? $file = $_FILES["filename"] : $file=null;
isset($_POST["youtube"]) ? $youtube_link = $db->escape($_post["youtube"]) : $youtube_link = null;

$filename = file::uploadFile($file) != false ? $error = null : header("Location: register.php?error=5");

$error = course::add($db, $project, $description, $file, $youtube_link);
header("Location: register.php?error=1");

?>