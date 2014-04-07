<?php
$query = $db->select("users", array("id"), array("id"=>$_SESSION["id"]));

if($query == null)
{
	if($_SERVER['PHP_SELF'] != "/index.php")
	{
		header("Location: ./index.php");
	}
}
else
{
if($_SERVER['PHP_SELF'] != "/portal.php")
	{
		header("Location: ./portal.php");
	}
}
?>