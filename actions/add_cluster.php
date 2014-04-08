<?php
require '../conf/config.php';
require '../lib/util.php';

$dataArray = getFriendlyData($_POST['form']);

echo "info-";
print_r($dataArray);

$temp = $dataArray['users'];
$users = array();

foreach($temp as $value)
{
	$user = new User($db, $value);
	array_push($users, $user);
}


Cluster::add($db, $dataArray['name'], $users, $dataArray['projects']);

?>