<?php
require_once("../../config/config.inc.php");
if(!isset($_SESSION["id"])) {
	header("Location: ../../../index.php");
}
?>