<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

function __autoload($n) {
	if(file_exists(strtolower($n).".class.php")) {
		include($n.".class.php");
	} elseif(file_exists("classes/".strtolower($n).".class.php")) {
		include("classes/".strtolower($n).".class.php");
	} elseif(file_exists("../classes/".strtolower($n).".class.php")) {
		include("../classes/".strtolower($n).".class.php");
	} elseif(file_exists("../../classes/".strtolower($n).".class.php")) {
		include("../../classes/".strtolower($n).".class.php");
	} else {
		trigger_error("Cannot find class ".$n, E_ERROR);
	}
}

session_start();
$db = new Database();