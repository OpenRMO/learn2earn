<?php
$temp = $db->select("users_clusters", array("cluster_id"), array("user_id"=>$_SESSION["id"]));
$clusterOfUser = $temp[0]["cluster_id"];
$temp = $db->select("clusters_projects", array("project_id"), array("cluster_id"=>$clusterOfUser));
if($temp != null)
{
	$projects = array();
	foreach($temp as $value)
	{
		array_push($projects, $value["project_id"]);
	}
}
?>