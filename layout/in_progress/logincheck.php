<?php
include "../../config/config.inc.php";

if(isset($_SESSION["id"]) == false)
{
	header("Location: ../index.php");
}
?>